<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Pk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PkController extends BaseController
{
    protected $pk = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pk $pk)
    {
        $this->middleware('auth:api');
        $this->pk= $pk;
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
            $pk  = DB::table('pk')
            ->join('kode_kantors', 'pk.kantor_id', '=', 'kode_kantors.id')
            ->select('pk.id','pk.no_pk','pk.namafile','pk.tanggal','pk.file',
            'pk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pk  = DB::table('pk')
            ->join('kode_kantors', 'pk.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pk.id','pk.no_pk','pk.namafile','pk.tanggal','pk.file',
            'pk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pk, 'File pk list');
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
            'no_pk'  => 'required|unique:pk',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:pdf'
        ],[
            'no_pk.unique' => 'no pk sudah ada dalam data',
            'no_pk.required' => 'no pk harus diisi',
            'namafile.required' => 'nama file harus diisi',
            'file.required' => 'file belum di input',
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
        $pk = $this->pk->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_pk'         => $request->get('no_pk'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pk', $file);

        return $this->sendResponse($pk, 'File telah diupload...');
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

        $pk = $this->pk->findOrFail($id);

        $pk->delete();
        $file = public_path("file/pk/".$pk->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pk, 'File sudah dihapus!');
        }else{
            unlink("file/pk/".$pk->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pk, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pk = $this->pk->findOrFail($id);
        $file = public_path("file/pk/".$pk->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_pk;
      $pk  = DB::table('pk')
      ->where('no_pk', $norek)
      ->select('pk.no_pk')
      ->get();

      if(!$pk->isEmpty()){
        return $this->sendResponse($pk, 'adarek');
      }else{
        return $this->sendResponse($pk, 'kosong');
      }

    }
}
