<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Pjkbadan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PjkbadanController extends BaseController
{
    protected $pjkbadan = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjkbadan $pjkbadan)
    {
        $this->middleware('auth:api');
        $this->pjkbadan= $pjkbadan;
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
        //$pjkbadan= $this->pjkbadan->latest()->get();
        if($levelLogin === 'admin'){
            $pjkbadan  = DB::table('pjkbadan')
            ->join('kode_kantors', 'pjkbadan.kantor_id', '=', 'kode_kantors.id')
            ->select('pjkbadan.id','pjkbadan.namafile','pjkbadan.tanggal','pjkbadan.file',
            'pjkbadan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjkbadan  = DB::table('pjkbadan')
            ->join('kode_kantors', 'pjkbadan.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjkbadan.id','pjkbadan.namafile','pjkbadan.tanggal','pjkbadan.file',
            'pjkbadan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjkbadan, 'pjkbadan list');
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
            'file.required' => 'nama file harus nama kantor (ex: cab-kpo.pdf)',
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
        $pjkbadan = $this->pjkbadan->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pjkbadan', $file);

        return $this->sendResponse($pjkbadan, 'File telah diupload...');
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
     * @param  \App\pjkbadan  $pjkbadan
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

        $pjkbadan = $this->pjkbadan->findOrFail($id);

        $pjkbadan->delete();
        $file = public_path("file/pjkbadan/".$pjkbadan->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pjkbadan, 'File sudah dihapus!');
        }else{
            unlink("file/pjkbadan/".$pjkbadan->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pjkbadan, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pjkbadan = $this->pjkbadan->findOrFail($id);
        $file = public_path("file/pjkbadan/".$pjkbadan->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
