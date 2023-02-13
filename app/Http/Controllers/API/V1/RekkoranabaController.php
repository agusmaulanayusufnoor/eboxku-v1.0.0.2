<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Rekkoranaba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RekkoranabaController extends BaseController
{
    protected $rekkoranaba = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Rekkoranaba $rekkoranaba)
    {
        $this->middleware('auth:api');
        $this->rekkoranaba= $rekkoranaba;
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

        if($levelLogin === 'admin'){
            $rekkoranaba  = DB::table('rekkoranaba')
            ->join('kode_kantors', 'rekkoranaba.kantor_id', '=', 'kode_kantors.id')
            ->select('rekkoranaba.id','rekkoranaba.jenis','rekkoranaba.no_rekening','rekkoranaba.namafile','rekkoranaba.tanggal','rekkoranaba.file',
            'rekkoranaba.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $rekkoranaba  = DB::table('rekkoranaba')
            ->join('kode_kantors', 'rekkoranaba.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('rekkoranaba.id','rekkoranaba.jenis','rekkoranaba.no_rekening','rekkoranaba.namafile','rekkoranaba.tanggal','rekkoranaba.file',
            'rekkoranaba.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($rekkoranaba, 'File Rekening Koran ABA list');
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
            'no_rekening'  => 'required',
            'namafile'     => 'required',
            'tanggal' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:pdf'
        ],[
            'no_rekening.unique' => 'no rekening sudah ada dalam data',
            'no_rekening.required' => 'no rekening harus diisi',
            'jenis.required' => 'tanggal harus dipilih',
            'tanggal.required' => 'tanggal harus diisi',
            'namafile.required' => 'nama file harus diisi',
            'file.required' => 'nama file harus nama bank (ex: brilink.pdf)',
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
        $acak = $this->acak_string(5);
        $file   = "00".$request->kantor_id.".".$request->no_rekening.".".$request->namafile.".".$acak.".".$nm->getClientOriginalName();
        $rekkoranaba = $this->rekkoranaba->create([
            'kantor_id'     => $request->get('kantor_id'),
            'jenis'         => $request->get('jenis'),
            'no_rekening'   => $request->get('no_rekening'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $request->tanggal,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/aba', $file);

        return $this->sendResponse($rekkoranaba, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rekkoranaba  $rekkoranaba
     * @return \Illuminate\Http\Response
     */
    public function show(Rekkoranaba $rekkoranaba)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rekkoranaba  $rekkoranaba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rekkoranaba $rekkoranaba)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekkoranaba  $rekkoranaba
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $rekkoranaba = $this->rekkoranaba->findOrFail($id);

        $rekkoranaba->delete();
        $file = public_path("file/aba/".$rekkoranaba->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($rekkoranaba, 'File sudah dihapus!');
        }else{
            unlink("file/aba/".$rekkoranaba->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($rekkoranaba, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $rekkoranaba = $this->rekkoranaba->findOrFail($id);
        $file = public_path("file/aba/".$rekkoranaba->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_rekening;
      $rekkoranaba  = DB::table('rekkoranaba')
      ->where('no_rekening', $norek)
      ->select('rekkoranaba.no_rekening')
      ->get();

      if(!$rekkoranaba->isEmpty()){
        return $this->sendResponse($rekkoranaba, 'adarek');
      }else{
        return $this->sendResponse($rekkoranaba, 'kosong');
      }

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

    public function filterkantor(Request $request)
    {
        //dd($request->all());
         $kantor_id = $request->kantor_id;


    //$id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$rekkoranaba= $this->rekkoranaba->latest()->get();
        if($levelLogin === 'admin'){


            $rekkoranaba  = DB::table('rekkoranaba')
            ->join('kode_kantors', 'rekkoranaba.kantor_id', '=', 'kode_kantors.id')
            ->where('rekkoranaba.kantor_id',$kantor_id)
            ->select('rekkoranaba.id','rekkoranaba.jenis','rekkoranaba.no_rekening','rekkoranaba.namafile','rekkoranaba.tanggal','rekkoranaba.file',
            'rekkoranaba.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($rekkoranaba, 'rekkoranaba list');
    }
    public function filterjenis(Request $request)
    {
        //dd($request->all());
         $jenis = $request->jenis;


    //$id_kantor  = Auth::user()->kantor_id;
      // $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$rekkoranaba= $this->rekkoranaba->latest()->get();
        //if($levelLogin === 'admin'){


            $rekkoranaba  = DB::table('rekkoranaba')
            ->join('kode_kantors', 'rekkoranaba.kantor_id', '=', 'kode_kantors.id')
            ->where('rekkoranaba.jenis',$jenis)
            ->select('rekkoranaba.id','rekkoranaba.jenis','rekkoranaba.no_rekening','rekkoranaba.namafile','rekkoranaba.tanggal','rekkoranaba.file',
            'rekkoranaba.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        //}
        return $this->sendResponse($rekkoranaba, 'rekkoranaba list');
    }
}
