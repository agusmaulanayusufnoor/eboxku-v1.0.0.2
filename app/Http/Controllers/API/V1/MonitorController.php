<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Monitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MonitorController extends BaseController
{
    protected $monitor = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Monitor $monitor)
    {
        $this->middleware('auth:api');
        $this->monitor= $monitor;
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
        //$monitor= $this->monitor->latest()->get();
        if($levelLogin === 'admin'){
            $monitor  = DB::table('monitor')
            ->join('kode_kantors', 'monitor.kantor_id', '=', 'kode_kantors.id')
            ->select('monitor.id','monitor.namafile','monitor.tanggal','monitor.file',
            'monitor.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $monitor  = DB::table('monitor')
            ->join('kode_kantors', 'monitor.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('monitor.id','monitor.namafile','monitor.tanggal','monitor.file',
            'monitor.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($monitor, 'monitor list');
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
        $monitor = $this->monitor->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/monitor', $file);

        return $this->sendResponse($monitor, 'File telah diupload...');
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
     * @param  \App\monitor  $monitor
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

        $monitor = $this->monitor->findOrFail($id);

        $monitor->delete();
        $file = public_path("file/monitor/".$monitor->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($monitor, 'File sudah dihapus!');
        }else{
            unlink("file/monitor/".$monitor->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($monitor, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $monitor = $this->monitor->findOrFail($id);
        $file = public_path("file/monitor/".$monitor->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
