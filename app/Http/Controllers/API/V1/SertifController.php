<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SertifController extends BaseController
{
    protected $sertifikat = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Sertifikat $sertifikat)
    {
        $this->middleware('auth:api');
        $this->sertifikat= $sertifikat;
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
            $sertifikat  = DB::table('sertifikat')
            ->join('kode_kantors', 'sertifikat.kantor_id', '=', 'kode_kantors.id')
            ->select('sertifikat.id','sertifikat.no_sertifikat','sertifikat.namafile','sertifikat.tanggal','sertifikat.file',
            'sertifikat.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $sertifikat  = DB::table('sertifikat')
            ->join('kode_kantors', 'sertifikat.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('sertifikat.id','sertifikat.no_sertifikat','sertifikat.namafile','sertifikat.tanggal','sertifikat.file',
            'sertifikat.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($sertifikat, 'File sertifikatitas list');
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
            'no_sertifikat'  => 'required|unique:sertifikat',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:pdf'
        ],[
            'no_sertifikat.unique' => 'no sertifikasi sudah ada dalam data',
            'no_sertifikat.required' => 'no sertifikasi harus diisi',
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
        $sertifikat = $this->sertifikat->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_sertifikat'         => $request->get('no_sertifikat'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/sertifikat', $file);

        return $this->sendResponse($sertifikat, 'File telah diupload...');
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

        $sertifikat = $this->sertifikat->findOrFail($id);

        $sertifikat->delete();
        $file = public_path("file/sertifikat/".$sertifikat->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($sertifikat, 'File sudah dihapus!');
        }else{
            unlink("file/sertifikat/".$sertifikat->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($sertifikat, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $sertifikat = $this->sertifikat->findOrFail($id);
        $file = public_path("file/sertifikat/".$sertifikat->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_sertifikat;
      $sertifikat  = DB::table('sertifikat')
      ->where('no_sertifikat', $norek)
      ->select('sertifikat.no_sertifikat')
      ->get();

      if(!$sertifikat->isEmpty()){
        return $this->sendResponse($sertifikat, 'adarek');
      }else{
        return $this->sendResponse($sertifikat, 'kosong');
      }

    }
}
