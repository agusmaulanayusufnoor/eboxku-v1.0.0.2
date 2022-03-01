<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Pjkbunga;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PjkbungaController extends BaseController
{
    protected $pjkbunga = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjkbunga $pjkbunga)
    {
        $this->middleware('auth:api');
        $this->pjkbunga= $pjkbunga;
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
        //$pjkbunga= $this->pjkbunga->latest()->get();
        if($levelLogin === 'admin'){
            $pjkbunga  = DB::table('pjkbunga')
            ->join('kode_kantors', 'pjkbunga.kantor_id', '=', 'kode_kantors.id')
            ->select('pjkbunga.id','pjkbunga.namafile','pjkbunga.tanggal','pjkbunga.file',
            'pjkbunga.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjkbunga  = DB::table('pjkbunga')
            ->join('kode_kantors', 'pjkbunga.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjkbunga.id','pjkbunga.namafile','pjkbunga.tanggal','pjkbunga.file',
            'pjkbunga.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjkbunga, 'pjkbunga list');
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
        $pjkbunga = $this->pjkbunga->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pjkbunga', $file);

        return $this->sendResponse($pjkbunga, 'File telah diupload...');
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
     * @param  \App\pjkbunga  $pjkbunga
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

        $pjkbunga = $this->pjkbunga->findOrFail($id);

        $pjkbunga->delete();
        $file = public_path("file/pjkbunga/".$pjkbunga->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pjkbunga, 'File sudah dihapus!');
        }else{
            unlink("file/pjkbunga/".$pjkbunga->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pjkbunga, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pjkbunga = $this->pjkbunga->findOrFail($id);
        $file = public_path("file/pjkbunga/".$pjkbunga->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
