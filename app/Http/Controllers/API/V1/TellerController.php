<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\teller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TellerController extends BaseController
{
    protected $teller = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Teller $teller)
    {
        $this->middleware('auth:api');
        $this->teller= $teller;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
        //$teller= $this->teller->latest()->get();
        if($levelLogin === 'admin'){
            $teller  = DB::table('teller')
            ->join('kode_kantors', 'teller.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','teller.otorisator_id', '=', 'otorisator.id')
            ->select('teller.id','teller.namafile','teller.tanggal','teller.file',
            'teller.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }else{
            $teller  = DB::table('teller')
            ->join('kode_kantors', 'teller.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','teller.otorisator_id', '=', 'otorisator.id')
            ->where('kantor_id', $id_kantor)
            ->select('teller.id','teller.namafile','teller.tanggal','teller.file',
            'teller.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($teller, 'teller list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'namafile' => 'required',
            'tanggal' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'file' => 'required|mimes:zip'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
            'file.required' => 'nama file harus nama kantor (ex: cab-kpo.zip)',
            'file.mimes' => 'file yang di upload harus berbentuk .zip'
        ]);


        $nm         = $request->file('file');

        $hari       = substr($request->tanggal,8,2);
        $bulan      = substr($request->tanggal,5,2);
        $tahun      = substr($request->tanggal,0,4);
        $arr        = array($hari,"/",$bulan,"/",$tahun);
        $arrnamefile        = array($hari,$bulan,$tahun);
        $datefile   = implode("",$arrnamefile);

        $date       = implode("",$arr);
        $acak = $this->acak_string(6);
        $file   = "00".$request->kantor_id.".".$request->namafile.".".$datefile.".".$acak.".".$nm->getClientOriginalName();
        $teller = $this->teller->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'otorisator_id' => $request->get('otorisator_id'),
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/teller', $file);

        return $this->sendResponse($teller, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\teller  $teller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $teller = $this->teller->findOrFail($id);

        $teller->delete();
        $file = public_path("file/teller/".$teller->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($teller, 'File sudah dihapus!');
        }else{
            unlink("file/teller/".$teller->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($teller, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $teller = $this->teller->findOrFail($id);
        $file = public_path("file/teller/".$teller->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }

    public function filterkantor(Request $request)
    {
        //dd($request->all());
        $nama_kantor = $request->kantor_id;


    //$id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$teller= $this->teller->latest()->get();
        if($levelLogin === 'admin'){


            $teller  = DB::table('teller')
            ->join('kode_kantors', 'teller.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','teller.otorisator_id', '=', 'otorisator.id')
            ->where('kode_kantors.nama_kantor',$nama_kantor)
            ->select('teller.id','teller.namafile','teller.tanggal','teller.file',
            'teller.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($teller, 'teller list');
    }

    public function filterotorisator(Request $request)
    {
        //dd($request->all());
         $oto_id = $request->otorisator_id;


        $id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$teller= $this->teller->latest()->get();
        if($levelLogin === 'admin'){


            $teller  = DB::table('teller')
            ->join('kode_kantors', 'teller.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','teller.otorisator_id', '=', 'otorisator.id')
            ->where('teller.otorisator_id',$oto_id)
            ->select('teller.id','teller.namafile','teller.tanggal','teller.file',
            'teller.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();

        }else{
            $teller  = DB::table('teller')
            ->join('kode_kantors', 'teller.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','teller.otorisator_id', '=', 'otorisator.id')
            ->where('kantor_id', $id_kantor)
            ->where('teller.otorisator_id',$oto_id)
            ->select('teller.id','teller.namafile','teller.tanggal','teller.file',
            'teller.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }
        return $this->sendResponse($teller, 'teller list');
    }

    function acak_string($panjang) {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter)-1);
            $string .= $karakter[$pos];
        }
        return $string;
    }

}
