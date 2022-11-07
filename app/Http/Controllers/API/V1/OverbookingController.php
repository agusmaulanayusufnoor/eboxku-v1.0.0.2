<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Overbooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OverbookingController extends BaseController
{
    protected $overbooking = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Overbooking $overbooking)
    {
        $this->middleware('auth:api');
        $this->overbooking= $overbooking;
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
        //$overbooking= $this->overbooking->latest()->get();
        if($levelLogin === 'admin'){
            $overbooking  = DB::table('overbooking')
            ->join('kode_kantors', 'overbooking.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','overbooking.otorisator_id', '=', 'otorisator.id')
            ->select('overbooking.id','overbooking.namafile','overbooking.tanggal','overbooking.file',
            'overbooking.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }else{
            $overbooking  = DB::table('overbooking')
            ->join('kode_kantors', 'overbooking.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','overbooking.otorisator_id', '=', 'otorisator.id')
            ->where('kantor_id', $id_kantor)
            ->select('overbooking.id','overbooking.namafile','overbooking.tanggal','overbooking.file',
            'overbooking.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($overbooking, 'overbooking list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        $file   = "00".$request->kantor_id.".".$request->namafile.".".$datefile.".".$nm->getClientOriginalName();
        $overbooking = $this->overbooking->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'otorisator_id' => $request->get('otorisator_id'),
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/ob', $file);

        return $this->sendResponse($overbooking, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Overbooking  $overbooking
     * @return \Illuminate\Http\Response
     */
    public function show(Overbooking $overbooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Overbooking  $overbooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Overbooking $overbooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Overbooking  $overbooking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $overbooking = $this->overbooking->findOrFail($id);

        $overbooking->delete();
        $file = public_path("file/ob/".$overbooking->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($overbooking, 'File sudah dihapus!');
        }else{
            unlink("file/ob/".$overbooking->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($overbooking, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $overbooking = $this->overbooking->findOrFail($id);
        $file = public_path("file/ob/".$overbooking->file);

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
         $kantor_id = $request->kantor_id;


    //$id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$overbooking= $this->overbooking->latest()->get();
        if($levelLogin === 'admin'){


            $overbooking  = DB::table('overbooking')
            ->join('kode_kantors', 'overbooking.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','overbooking.otorisator_id', '=', 'otorisator.id')
            ->where('overbooking.kantor_id',$kantor_id)
            ->select('overbooking.id','overbooking.namafile','overbooking.tanggal','overbooking.file',
            'overbooking.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($overbooking, 'overbooking list');
    }

    public function filterotorisator(Request $request)
    {
        //dd($request->all());
         $oto_id = $request->otorisator_id;


    $id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$overbooking= $this->overbooking->latest()->get();
        if($levelLogin === 'admin'){

            $overbooking  = DB::table('overbooking')
            ->join('kode_kantors', 'overbooking.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','overbooking.otorisator_id', '=', 'otorisator.id')
            ->where('overbooking.otorisator_id',$oto_id)
            ->select('overbooking.id','overbooking.namafile','overbooking.tanggal','overbooking.file',
            'overbooking.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }else{
            $overbooking  = DB::table('overbooking')
            ->join('kode_kantors', 'overbooking.kantor_id', '=', 'kode_kantors.id')
            ->join('otorisator','overbooking.otorisator_id', '=', 'otorisator.id')
            ->where('overbooking.otorisator_id',$oto_id)
            ->where('kantor_id', $id_kantor)
            ->select('overbooking.id','overbooking.namafile','overbooking.tanggal','overbooking.file',
            'overbooking.kantor_id','kode_kantors.nama_kantor','otorisator.namaotorisator')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($overbooking, 'overbooking list');
    }
}
