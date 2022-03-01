<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Pjkpph21;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Pjkpph21Controller extends BaseController
{
    protected $pjkpph21 = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjkpph21 $pjkpph21)
    {
        $this->middleware('auth:api');
        $this->pjkpph21= $pjkpph21;
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
        //$pjkpph21= $this->pjkpph21->latest()->get();
        if($levelLogin === 'admin'){
            $pjkpph21  = DB::table('pjkpph21')
            ->join('kode_kantors', 'pjkpph21.kantor_id', '=', 'kode_kantors.id')
            ->select('pjkpph21.id','pjkpph21.namafile','pjkpph21.tanggal','pjkpph21.file',
            'pjkpph21.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjkpph21  = DB::table('pjkpph21')
            ->join('kode_kantors', 'pjkpph21.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjkpph21.id','pjkpph21.namafile','pjkpph21.tanggal','pjkpph21.file',
            'pjkpph21.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjkpph21, 'pjkpph21 list');
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
        $pjkpph21 = $this->pjkpph21->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pjkpph21', $file);

        return $this->sendResponse($pjkpph21, 'File telah diupload...');
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
     * @param  \App\pjkpph21  $pjkpph21
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

        $pjkpph21 = $this->pjkpph21->findOrFail($id);

        $pjkpph21->delete();
        $file = public_path("file/pjkpph21/".$pjkpph21->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pjkpph21, 'File sudah dihapus!');
        }else{
            unlink("file/pjkpph21/".$pjkpph21->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pjkpph21, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pjkpph21 = $this->pjkpph21->findOrFail($id);
        $file = public_path("file/pjkpph21/".$pjkpph21->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
