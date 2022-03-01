<?php

namespace App\Http\Controllers\API\V1;

use App\Models\akta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AktaController extends BaseController
{
    protected $akta = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Akta $akta)
    {
        $this->middleware('auth:api');
        $this->akta= $akta;
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
            $akta  = DB::table('akta')
            ->join('kode_kantors', 'akta.kantor_id', '=', 'kode_kantors.id')
            ->select('akta.id','akta.no_akta','akta.namafile','akta.tanggal','akta.file',
            'akta.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $akta  = DB::table('akta')
            ->join('kode_kantors', 'akta.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('akta.id','akta.no_akta','akta.namafile','akta.tanggal','akta.file',
            'akta.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($akta, 'File akta list');
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
            'no_akta'  => 'required|unique:akta',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:pdf'
        ],[
            'no_akta.unique' => 'no akta sudah ada dalam data',
            'no_akta.required' => 'no akta harus diisi',
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
        $akta = $this->akta->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_akta'         => $request->get('no_akta'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/akta', $file);

        return $this->sendResponse($akta, 'File telah diupload...');
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

        $akta = $this->akta->findOrFail($id);

        $akta->delete();
        $file = public_path("file/akta/".$akta->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($akta, 'File sudah dihapus!');
        }else{
            unlink("file/akta/".$akta->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($akta, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $akta = $this->akta->findOrFail($id);
        $file = public_path("file/akta/".$akta->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_akta;
      $akta  = DB::table('akta')
      ->where('no_akta', $norek)
      ->select('akta.no_akta')
      ->get();

      if(!$akta->isEmpty()){
        return $this->sendResponse($akta, 'adarek');
      }else{
        return $this->sendResponse($akta, 'kosong');
      }

    }
}
