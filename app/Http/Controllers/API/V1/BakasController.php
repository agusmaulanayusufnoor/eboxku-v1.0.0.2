<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Bakas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BakasController extends BaseController
{
    protected $bakas = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Bakas $bakas)
    {
        $this->middleware('auth:api');
        $this->bakas= $bakas;
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
        //$bakas= $this->bakas->latest()->get();
        if($levelLogin === 'admin'){
            $bakas  = DB::table('bakas')
            ->join('kode_kantors', 'bakas.kantor_id', '=', 'kode_kantors.id')
            ->select('bakas.id','bakas.namafile','bakas.tanggal','bakas.file',
            'bakas.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $bakas  = DB::table('bakas')
            ->join('kode_kantors', 'bakas.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('bakas.id','bakas.namafile','bakas.tanggal','bakas.file',
            'bakas.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($bakas, 'Bakas list');
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
            'tanggal' => 'unique:bakas,tanggal',
            'file' => 'required|mimes:zip'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
            'tanggal.unique' => 'tanggal sudah ada dalam data',
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
        $acak = $this->acak_string(5);
        $file   = "01020101.600324.OP001UN-A".".00".$request->kantor_id.".".$request->namafile.".".$acak.".".$nm->getClientOriginalName();
        $bakas = $this->bakas->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/ba', $file);

        return $this->sendResponse($bakas, 'File telah diupload...');
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
     * @param  \App\Bakas  $bakas
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

        $bakas = $this->bakas->findOrFail($id);

        $bakas->delete();
        $file = public_path("file/ba/".$bakas->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($bakas, 'File sudah dihapus!');
        }else{
            unlink("file/ba/".$bakas->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($bakas, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $bakas = $this->bakas->findOrFail($id);
        $file = public_path("file/ba/".$bakas->file);

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
      $bakas  = DB::table('bakas')
      ->where('tanggal', $date)
      ->where('kantor_id', $id_kantor)
      ->select('bakas.tanggal')
      ->get();

      if(!$bakas->isEmpty()){
        return $this->sendResponse($bakas, 'adatgl');
      }else{
        return $this->sendResponse($bakas, 'kosong');
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
