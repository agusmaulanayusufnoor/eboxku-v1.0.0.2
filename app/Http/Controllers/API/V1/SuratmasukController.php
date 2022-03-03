<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Suratmasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuratmasukController extends BaseController
{
    protected $suratmasuk = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Suratmasuk $suratmasuk)
    {
        $this->middleware('auth:api');
        $this->suratmasuk= $suratmasuk;
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
            $suratmasuk  = DB::table('suratmasuk')
            ->join('kode_kantors', 'suratmasuk.kantor_id', '=', 'kode_kantors.id')
            ->select('suratmasuk.id','suratmasuk.no_surat','suratmasuk.namafile','suratmasuk.tanggal','suratmasuk.file',
            'suratmasuk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $suratmasuk  = DB::table('suratmasuk')
            ->join('kode_kantors', 'suratmasuk.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('suratmasuk.id','suratmasuk.no_surat','suratmasuk.namafile','suratmasuk.tanggal','suratmasuk.file',
            'suratmasuk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($suratmasuk, 'File suratmasuk list');
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
            'no_surat'  => 'required|unique:suratmasuk',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:pdf'
        ],[
            'no_surat.unique' => 'no surat sudah ada dalam data',
            'no_surat.required' => 'no surat harus diisi',
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
        $suratmasuk = $this->suratmasuk->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_surat'         => $request->get('no_surat'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/suratmasuk', $file);

        return $this->sendResponse($suratmasuk, 'File telah diupload...');
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

        $suratmasuk = $this->suratmasuk->findOrFail($id);

        $suratmasuk->delete();
        $file = public_path("file/suratmasuk/".$suratmasuk->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($suratmasuk, 'File sudah dihapus!');
        }else{
            unlink("file/suratmasuk/".$suratmasuk->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($suratmasuk, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $suratmasuk = $this->suratmasuk->findOrFail($id);
        $file = public_path("file/suratmasuk/".$suratmasuk->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_surat;
      $suratmasuk  = DB::table('suratmasuk')
      ->where('no_surat', $norek)
      ->select('suratmasuk.no_surat')
      ->get();

      if(!$suratmasuk->isEmpty()){
        return $this->sendResponse($suratmasuk, 'adarek');
      }else{
        return $this->sendResponse($suratmasuk, 'kosong');
      }

    }
}
