<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Lapkap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LapkapController extends BaseController
{
    protected $lapkap = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Lapkap $lapkap)
    {
        $this->middleware('auth:api');
        $this->lapkap= $lapkap;
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
        //$lapkap= $this->lapkap->latest()->get();
        if($levelLogin === 'admin'){
            $lapkap  = DB::table('lapkap')
            ->join('kode_kantors', 'lapkap.kantor_id', '=', 'kode_kantors.id')
            ->select('lapkap.id','lapkap.namafile','lapkap.tanggal','lapkap.file',
            'lapkap.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $lapkap  = DB::table('lapkap')
            ->join('kode_kantors', 'lapkap.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('lapkap.id','lapkap.namafile','lapkap.tanggal','lapkap.file',
            'lapkap.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($lapkap, 'lapkap list');
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
        $lapkap = $this->lapkap->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/lapkap', $file);

        return $this->sendResponse($lapkap, 'File telah diupload...');
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
     * @param  \App\lapkap  $lapkap
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

        $lapkap = $this->lapkap->findOrFail($id);

        $lapkap->delete();
        $file = public_path("file/lapkap/".$lapkap->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($lapkap, 'File sudah dihapus!');
        }else{
            unlink("file/lapkap/".$lapkap->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($lapkap, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $lapkap = $this->lapkap->findOrFail($id);
        $file = public_path("file/lapkap/".$lapkap->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
