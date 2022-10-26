<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Pelunasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelunasanController extends BaseController
{
    protected $pelunasan = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pelunasan $pelunasan)
    {
        $this->middleware('auth:api');
        $this->pelunasan= $pelunasan;
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

        // if($levelLogin === 'admin'){
        //     $pelunasan  = DB::table('pelunasan')
        //     ->join('kode_kantors', 'pelunasan.kantor_id', '=', 'kode_kantors.id')
        //     ->select('pelunasan.id','pelunasan.no_rekening','pelunasan.namafile','pelunasan.tanggal','pelunasan.file',
        //     'pelunasan.kantor_id','kode_kantors.nama_kantor')
        //     ->orderBy('id','desc')
        //     ->get();
        // }else{
        //     $pelunasan  = DB::table('pelunasan')
        //     ->join('kode_kantors', 'pelunasan.kantor_id', '=', 'kode_kantors.id')
        //     ->where('kantor_id', $id_kantor)
        //     ->select('pelunasan.id','pelunasan.no_rekening','pelunasan.namafile','pelunasan.tanggal','pelunasan.file',
        //     'pelunasan.kantor_id','kode_kantors.nama_kantor')
        //     ->orderBy('id','desc')
        //     ->get();
        // }
        $pelunasan  = DB::table('pelunasan')
            ->join('kode_kantors', 'pelunasan.kantor_id', '=', 'kode_kantors.id')
            ->select('pelunasan.id','pelunasan.no_rekening','pelunasan.namafile','pelunasan.tanggal','pelunasan.file',
            'pelunasan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        return $this->sendResponse($pelunasan, 'File pelunasan list');
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
            'no_rekening'  => 'required|unique:pelunasan',
            'namafile'     => 'required',
            'tanggal' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:pdf'
        ],[
            'no_rekening.unique' => 'no rekening sudah ada dalam data',
            'no_rekening.required' => 'no rekening harus diisi',
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
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
        $pelunasan = $this->pelunasan->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_rekening'   => $request->get('no_rekening'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/lunas', $file);

        return $this->sendResponse($pelunasan, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     *  @param  \App\Models\Pelunasan  $pelunasan
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

        $pelunasan = $this->pelunasan->findOrFail($id);

        $pelunasan->delete();
        $file = public_path("file/lunas/".$pelunasan->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pelunasan, 'File sudah dihapus!');
        }else{
            unlink("file/lunas/".$pelunasan->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pelunasan, 'File sudah dihapus!');
        }
    }
    public function downloadfile($id)
    {
        $pelunasan = $this->pelunasan->findOrFail($id);
        $file = public_path("file/lunas/".$pelunasan->file);

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
      $pelunasan  = DB::table('pelunasan')
      ->where('no_rekening', $norek)
      ->select('pelunasan.no_rekening')
      ->get();

      if(!$pelunasan->isEmpty()){
        return $this->sendResponse($pelunasan, 'adarek');
      }else{
        return $this->sendResponse($pelunasan, 'kosong');
      }

    }
}
