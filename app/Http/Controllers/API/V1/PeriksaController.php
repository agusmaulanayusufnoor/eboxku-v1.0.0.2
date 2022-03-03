<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Periksa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends BaseController
{
    protected $periksa = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Periksa $periksa)
    {
        $this->middleware('auth:api');
        $this->periksa= $periksa;
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
        //$periksa= $this->periksa->latest()->get();
        if($levelLogin === 'admin'){
            $periksa  = DB::table('periksa')
            ->join('kode_kantors', 'periksa.kantor_id', '=', 'kode_kantors.id')
            ->select('periksa.id','periksa.namafile','periksa.tanggal','periksa.file',
            'periksa.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $periksa  = DB::table('periksa')
            ->join('kode_kantors', 'periksa.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('periksa.id','periksa.namafile','periksa.tanggal','periksa.file',
            'periksa.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($periksa, 'periksa list');
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
            'file' => 'required|mimes:pdf'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'file.required' => 'nama file harus di isi',
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
        $periksa = $this->periksa->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/periksa', $file);

        return $this->sendResponse($periksa, 'File telah diupload...');
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
     * @param  \App\periksa  $periksa
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

        $periksa = $this->periksa->findOrFail($id);

        $periksa->delete();
        $file = public_path("file/periksa/".$periksa->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($periksa, 'File sudah dihapus!');
        }else{
            unlink("file/periksa/".$periksa->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($periksa, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $periksa = $this->periksa->findOrFail($id);
        $file = public_path("file/periksa/".$periksa->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
