<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Kaskecil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KaskecilController extends BaseController
{
    protected $kaskecil = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Kaskecil $kaskecil)
    {
        $this->middleware('auth:api');
        $this->kaskecil= $kaskecil;
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
        //$kaskecil= $this->kaskecil->latest()->get();
        if($levelLogin === 'admin'){
            $kaskecil  = DB::table('kaskecil')
            ->join('kode_kantors', 'kaskecil.kantor_id', '=', 'kode_kantors.id')
            ->select('kaskecil.id','kaskecil.namafile','kaskecil.tanggal','kaskecil.file',
            'kaskecil.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $kaskecil  = DB::table('kaskecil')
            ->join('kode_kantors', 'kaskecil.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('kaskecil.id','kaskecil.namafile','kaskecil.tanggal','kaskecil.file',
            'kaskecil.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($kaskecil, 'kaskecil list');
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
            'tanggal' => 'required',
            'file' => 'required|mimes:zip'
        ],[
            'namafile.required' => 'nama file harus diisi',
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
        $kaskecil = $this->kaskecil->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/kk', $file);

        return $this->sendResponse($kaskecil, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kaskecil  $kaskecil
     * @return \Illuminate\Http\Response
     */
    public function show(Kaskecil $kaskecil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kaskecil  $kaskecil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kaskecil $kaskecil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kaskecil  $kaskecil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $kaskecil = $this->kaskecil->findOrFail($id);

        $kaskecil->delete();
        $file = public_path("file/kk/".$kaskecil->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($kaskecil, 'File sudah dihapus!');
        }else{
            unlink("file/kk/".$kaskecil->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($kaskecil, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $kaskecil = $this->kaskecil->findOrFail($id);
        $file = public_path("file/kk/".$kaskecil->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
