<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Tabungan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TabunganController extends BaseController
{
    protected $tabungan = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Tabungan $tabungan)
    {
        $this->middleware('auth:api');
        $this->tabungan= $tabungan;
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
            $tabungan  = DB::table('tabungan')
            ->join('kode_kantors', 'tabungan.kantor_id', '=', 'kode_kantors.id')
            ->select('tabungan.id','tabungan.no_rekening','tabungan.namafile','tabungan.tanggal','tabungan.file',
            'tabungan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $tabungan  = DB::table('tabungan')
            ->join('kode_kantors', 'tabungan.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('tabungan.id','tabungan.no_rekening','tabungan.namafile','tabungan.tanggal','tabungan.file',
            'tabungan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($tabungan, 'File Tabungan list');
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
            'no_rekening'  => 'required|unique:tabungan',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:zip'
        ],[
            'no_rekening.unique' => 'no rekening sudah ada dalam data',
            'no_rekening.required' => 'no rekening harus diisi',
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

        $file   = "00".$request->kantor_id.".".$request->no_rekening.".".$request->namafile.".".$datefile.".".$nm->getClientOriginalName();
        $tabungan = $this->tabungan->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_rekening'     => $request->get('no_rekening'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/tab', $file);

        return $this->sendResponse($tabungan, 'File telah diupload...');
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

        $tabungan = $this->tabungan->findOrFail($id);

        $tabungan->delete();
        $file = public_path("file/tab/".$tabungan->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($tabungan, 'File sudah dihapus!');
        }else{
            unlink("file/tab/".$tabungan->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($tabungan, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $tabungan = $this->tabungan->findOrFail($id);
        $file = public_path("file/tab/".$tabungan->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_rekening;
      $tabungan  = DB::table('tabungan')
      ->where('no_rekening', $norek)
      ->select('tabungan.no_rekening')
      ->get();

      if(!$tabungan->isEmpty()){
        return $this->sendResponse($tabungan, 'adarek');
      }else{
        return $this->sendResponse($tabungan, 'kosong');
      }

    }
}
