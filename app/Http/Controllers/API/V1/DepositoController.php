<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\deposito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepositoController extends BaseController
{
    protected $deposito = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Deposito $deposito)
    {
        $this->middleware('auth:api');
        $this->deposito= $deposito;
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
            $deposito  = DB::table('deposito')
            ->join('kode_kantors', 'deposito.kantor_id', '=', 'kode_kantors.id')
            ->select('deposito.id','deposito.no_rekening','deposito.namafile','deposito.tanggal','deposito.file',
            'deposito.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $deposito  = DB::table('deposito')
            ->join('kode_kantors', 'deposito.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('deposito.id','deposito.no_rekening','deposito.namafile','deposito.tanggal','deposito.file',
            'deposito.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($deposito, 'File deposito list');
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
            'no_rekening'  => 'required|unique:deposito',
            'namafile'     => 'required',
            'tanggal' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:zip'
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
        $deposito = $this->deposito->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_rekening'   => $request->get('no_rekening'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/dep', $file);

        return $this->sendResponse($deposito, 'File telah diupload...');
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

        $deposito = $this->deposito->findOrFail($id);

        $deposito->delete();
        $file = public_path("file/dep/".$deposito->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($deposito, 'File sudah dihapus!');
        }else{
            unlink("file/dep/".$deposito->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($deposito, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $deposito = $this->deposito->findOrFail($id);
        $file = public_path("file/dep/".$deposito->file);

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
      $deposito  = DB::table('deposito')
      ->where('no_rekening', $norek)
      ->select('deposito.no_rekening')
      ->get();

      if(!$deposito->isEmpty()){
        return $this->sendResponse($deposito, 'adarek');
      }else{
        return $this->sendResponse($deposito, 'kosong');
      }

    }

}
