<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Sedir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SedirController extends BaseController
{
    protected $sedir = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Sedir $sedir)
    {
        $this->middleware('auth:api');
        $this->sedir= $sedir;
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
            $sedir  = DB::table('sedir')
            ->join('kode_kantors', 'sedir.kantor_id', '=', 'kode_kantors.id')
            ->select('sedir.id','sedir.no_se','sedir.namafile','sedir.tanggal','sedir.file',
            'sedir.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $sedir  = DB::table('sedir')
            ->join('kode_kantors', 'sedir.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('sedir.id','sedir.no_se','sedir.namafile','sedir.tanggal','sedir.file',
            'sedir.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($sedir, 'File sedir list');
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
            'no_se'  => 'required|unique:sedir',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:zip'
        ],[
            'no_se.unique' => 'no sk sudah ada dalam data',
            'no_se.required' => 'no sk harus diisi',
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
        $sedir = $this->sedir->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_se'         => $request->get('no_se'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/se', $file);

        return $this->sendResponse($sedir, 'File telah diupload...');
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

        $sedir = $this->sedir->findOrFail($id);

        $sedir->delete();
        $file = public_path("file/se/".$sedir->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($sedir, 'File sudah dihapus!');
        }else{
            unlink("file/se/".$sedir->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($sedir, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $sedir = $this->sedir->findOrFail($id);
        $file = public_path("file/se/".$sedir->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_se;
      $sedir  = DB::table('sedir')
      ->where('no_se', $norek)
      ->select('sedir.no_se')
      ->get();

      if(!$sedir->isEmpty()){
        return $this->sendResponse($sedir, 'adarek');
      }else{
        return $this->sendResponse($sedir, 'kosong');
      }

    }
}
