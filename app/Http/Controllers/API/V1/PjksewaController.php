<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Pjksewa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PjksewaController extends BaseController
{
    protected $pjksewa = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjksewa $pjksewa)
    {
        $this->middleware('auth:api');
        $this->pjksewa= $pjksewa;
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
        //$pjksewa= $this->pjksewa->latest()->get();
        if($levelLogin === 'admin'){
            $pjksewa  = DB::table('pjksewa')
            ->join('kode_kantors', 'pjksewa.kantor_id', '=', 'kode_kantors.id')
            ->select('pjksewa.id','pjksewa.namafile','pjksewa.tanggal','pjksewa.file',
            'pjksewa.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjksewa  = DB::table('pjksewa')
            ->join('kode_kantors', 'pjksewa.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjksewa.id','pjksewa.namafile','pjksewa.tanggal','pjksewa.file',
            'pjksewa.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjksewa, 'pjksewa list');
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
        $pjksewa = $this->pjksewa->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pjksewa', $file);

        return $this->sendResponse($pjksewa, 'File telah diupload...');
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
     * @param  \App\pjksewa  $pjksewa
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

        $pjksewa = $this->pjksewa->findOrFail($id);

        $pjksewa->delete();
        $file = public_path("file/pjksewa/".$pjksewa->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pjksewa, 'File sudah dihapus!');
        }else{
            unlink("file/pjksewa/".$pjksewa->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pjksewa, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pjksewa = $this->pjksewa->findOrFail($id);
        $file = public_path("file/pjksewa/".$pjksewa->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
