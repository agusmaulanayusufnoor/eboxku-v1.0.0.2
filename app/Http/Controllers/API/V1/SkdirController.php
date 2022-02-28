<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Skdir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SkdirController extends BaseController
{
    protected $skdir = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Skdir $skdir)
    {
        $this->middleware('auth:api');
        $this->skdir= $skdir;
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
            $skdir  = DB::table('skdir')
            ->join('kode_kantors', 'skdir.kantor_id', '=', 'kode_kantors.id')
            ->select('skdir.id','skdir.no_sk','skdir.namafile','skdir.tanggal','skdir.file',
            'skdir.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $skdir  = DB::table('skdir')
            ->join('kode_kantors', 'skdir.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('skdir.id','skdir.no_sk','skdir.namafile','skdir.tanggal','skdir.file',
            'skdir.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($skdir, 'File skdir list');
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
            'no_sk'  => 'required|unique:skdir',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:zip'
        ],[
            'no_sk.unique' => 'no sk sudah ada dalam data',
            'no_sk.required' => 'no sk harus diisi',
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
        $skdir = $this->skdir->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_sk'         => $request->get('no_sk'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/sk', $file);

        return $this->sendResponse($skdir, 'File telah diupload...');
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

        $skdir = $this->skdir->findOrFail($id);

        $skdir->delete();
        $file = public_path("file/sk/".$skdir->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($skdir, 'File sudah dihapus!');
        }else{
            unlink("file/sk/".$skdir->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($skdir, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $skdir = $this->skdir->findOrFail($id);
        $file = public_path("file/sk/".$skdir->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_sk;
      $skdir  = DB::table('skdir')
      ->where('no_sk', $norek)
      ->select('skdir.no_sk')
      ->get();

      if(!$skdir->isEmpty()){
        return $this->sendResponse($skdir, 'adarek');
      }else{
        return $this->sendResponse($skdir, 'kosong');
      }

    }
}
