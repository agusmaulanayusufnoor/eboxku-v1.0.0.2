<?php

namespace App\Http\Controllers\API\V1;

use App\Models\legal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LegalController extends BaseController
{
    protected $legal = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Legal $legal)
    {
        $this->middleware('auth:api');
        $this->legal= $legal;
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
            $legal  = DB::table('legal')
            ->join('kode_kantors', 'legal.kantor_id', '=', 'kode_kantors.id')
            ->select('legal.id','legal.no_legal','legal.namafile','legal.tanggal','legal.file',
            'legal.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $legal  = DB::table('legal')
            ->join('kode_kantors', 'legal.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('legal.id','legal.no_legal','legal.namafile','legal.tanggal','legal.file',
            'legal.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($legal, 'File legalitas list');
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
            'no_legal'  => 'required|unique:legal',
            'namafile'     => 'required',
            'tanggal'      => 'required',
            'file'         => 'required|mimes:pdf'
        ],[
            'no_legal.unique' => 'no sk sudah ada dalam data',
            'no_legal.required' => 'no sk harus diisi',
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
        $legal = $this->legal->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_legal'         => $request->get('no_legal'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/legal', $file);

        return $this->sendResponse($legal, 'File telah diupload...');
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

        $legal = $this->legal->findOrFail($id);

        $legal->delete();
        $file = public_path("file/legal/".$legal->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($legal, 'File sudah dihapus!');
        }else{
            unlink("file/legal/".$legal->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($legal, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $legal = $this->legal->findOrFail($id);
        $file = public_path("file/legal/".$legal->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_legal;
      $legal  = DB::table('legal')
      ->where('no_legal', $norek)
      ->select('legal.no_legal')
      ->get();

      if(!$legal->isEmpty()){
        return $this->sendResponse($legal, 'adarek');
      }else{
        return $this->sendResponse($legal, 'kosong');
      }

    }
}
