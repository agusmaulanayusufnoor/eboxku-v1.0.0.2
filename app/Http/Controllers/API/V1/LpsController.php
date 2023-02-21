<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Lps;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LpsController extends BaseController
{
    protected $lps = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Lps $lps)
    {
        $this->middleware('auth:api');
        $this->lps= $lps;
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
        //$lps= $this->lps->latest()->get();
        if($levelLogin === 'admin'){
            $lps  = DB::table('lps')
            ->join('kode_kantors', 'lps.kantor_id', '=', 'kode_kantors.id')
            ->select('lps.id','lps.namafile','lps.tanggal','lps.file',
            'lps.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $lps  = DB::table('lps')
            ->join('kode_kantors', 'lps.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('lps.id','lps.namafile','lps.tanggal','lps.file',
            'lps.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($lps, 'Lps list');
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
            'tanggal' => 'unique:lps,tanggal',
            'file' => 'required|mimes:pdf'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
            'tanggal.unique' => 'tanggal sudah ada dalam data',
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
        $acak = $this->acak_string(5);
        $file   = $acak.".".$nm->getClientOriginalName();
        $lps = $this->lps->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/ba', $file);

        return $this->sendResponse($lps, 'File telah diupload...');
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
     * @param  \App\Lps  $lps
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

        $lps = $this->lps->findOrFail($id);

        $lps->delete();
        $file = public_path("file/ba/".$lps->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($lps, 'File sudah dihapus!');
        }else{
            unlink("file/ba/".$lps->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($lps, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $lps = $this->lps->findOrFail($id);
        $file = public_path("file/ba/".$lps->file);

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
      $lps  = DB::table('lps')
      ->where('tanggal', $date)
      ->where('kantor_id', $id_kantor)
      ->select('lps.tanggal')
      ->get();

      if(!$lps->isEmpty()){
        return $this->sendResponse($lps, 'adatgl');
      }else{
        return $this->sendResponse($lps, 'kosong');
      }

    }

    function acak_string($panjang) {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter)-1);
            $string .= $karakter[$pos];
        }
        return $string;
    }
}
