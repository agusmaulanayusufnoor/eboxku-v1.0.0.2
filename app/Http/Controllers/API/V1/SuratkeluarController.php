<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Suratkeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuratkeluarController extends BaseController
{
    protected $suratkeluar = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Suratkeluar $suratkeluar)
    {
        $this->middleware('auth:api');
        $this->suratkeluar= $suratkeluar;
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
            $suratkeluar  = DB::table('suratkeluar')
            ->join('kode_kantors', 'suratkeluar.kantor_id', '=', 'kode_kantors.id')
            ->select('suratkeluar.id','suratkeluar.no_surat','suratkeluar.namafile','suratkeluar.tanggal','suratkeluar.file',
            'suratkeluar.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $suratkeluar  = DB::table('suratkeluar')
            ->join('kode_kantors', 'suratkeluar.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('suratkeluar.id','suratkeluar.no_surat','suratkeluar.namafile','suratkeluar.tanggal','suratkeluar.file',
            'suratkeluar.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($suratkeluar, 'File suratkeluar list');
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
            'no_surat'  => 'required|unique:suratkeluar',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:pdf'
        ],[
            'no_surat.unique' => 'no surat sudah ada dalam data',
            'no_surat.required' => 'no surat harus diisi',
            'namafile.required' => 'nama file harus diisi',
            'file.required' => 'file belum di input',
            'file.mimes' => 'file yang di upload harus berbentuk .pdf'
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
        $suratkeluar = $this->suratkeluar->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_surat'         => $request->get('no_surat'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/suratkeluar', $file);

        return $this->sendResponse($suratkeluar, 'File telah diupload...');
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
     * @param  int  $id
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

        $suratkeluar = $this->suratkeluar->findOrFail($id);

        $suratkeluar->delete();
        $file = public_path("file/suratkeluar/".$suratkeluar->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($suratkeluar, 'File sudah dihapus!');
        }else{
            unlink("file/suratkeluar/".$suratkeluar->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($suratkeluar, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $suratkeluar = $this->suratkeluar->findOrFail($id);
        $file = public_path("file/suratkeluar/".$suratkeluar->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_surat;
      $suratkeluar  = DB::table('suratkeluar')
      ->where('no_surat', $norek)
      ->select('suratkeluar.no_surat')
      ->get();

      if(!$suratkeluar->isEmpty()){
        return $this->sendResponse($suratkeluar, 'adarek');
      }else{
        return $this->sendResponse($suratkeluar, 'kosong');
      }

    }
}
