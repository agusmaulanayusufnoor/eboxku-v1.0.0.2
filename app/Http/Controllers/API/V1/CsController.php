<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Cs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CsController extends BaseController
{
    protected $cs = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cs $cs)
    {
        $this->middleware('auth:api');
        $this->cs= $cs;
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
        //$cs= $this->cs->latest()->get();
        if($levelLogin === 'admin'){
            $cs  = DB::table('cs')
            ->join('kode_kantors', 'cs.kantor_id', '=', 'kode_kantors.id')
            ->select('cs.id','cs.namafile','cs.tanggal','cs.file',
            'cs.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $cs  = DB::table('cs')
            ->join('kode_kantors', 'cs.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('cs.id','cs.namafile','cs.tanggal','cs.file',
            'cs.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($cs, 'Cs list');
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
             'tanggal' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'tanggal' => 'unique:cs,tanggal',
            'file' => 'required|mimes:pdf'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
            'tanggal.unique' => 'tanggal sudah ada dalam data',
            'file.required' => 'file pdf belum diambil',
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

        $file   = "01020101.600324.OP001UN-A".".00".$request->kantor_id.".".$request->namafile.".".$datefile.".".$nm->getClientOriginalName();
        $cs = $this->cs->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/ba', $file);

        return $this->sendResponse($cs, 'File telah diupload...');
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
     * @param  \App\Cs  $cs
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

        $cs = $this->cs->findOrFail($id);

        $cs->delete();
        $file = public_path("file/ba/".$cs->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($cs, 'File sudah dihapus!');
        }else{
            unlink("file/ba/".$cs->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($cs, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $cs = $this->cs->findOrFail($id);
        $file = public_path("file/ba/".$cs->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }

    public function cektgl(Request $request)
    {
      $id_kantor = $request->kantor_id;
      $hari       = substr($request->tanggal,8,2);
        $bulan      = substr($request->tanggal,5,2);
        $tahun      = substr($request->tanggal,0,4);
        $arr        = array($hari,"/",$bulan,"/",$tahun);
        $date       = implode("",$arr);
      $cs  = DB::table('cs')
      ->where('tanggal', $date)
      ->where('kantor_id', $id_kantor)
      ->select('cs.tanggal')
      ->get();

      if(!$cs->isEmpty()){
        return $this->sendResponse($cs, 'adatgl');
      }else{
        return $this->sendResponse($cs, 'kosong');
      }

    }
}
