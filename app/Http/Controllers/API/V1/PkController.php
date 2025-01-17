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
            ->select('pk.id','pk.no_pk','pk.namamitra','pk.namafile','pk.tglmulai','pk.tglakhir','pk.status','pk.file',
            'pk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pk  = DB::table('pk')
            ->join('kode_kantors', 'pk.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pk.id','pk.no_pk','pk.namamitra','pk.namafile','pk.tglmulai','pk.tglakhir','pk.status','pk.file',
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
            'namamitra'     => 'required',
            'tglmulai'      => 'required',
            'tglmulai' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'tglakhir'      => 'required',
            'tglakhir' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:pdf'
        ],[
            'no_pk.unique' => 'no pks sudah ada dalam data',
            'no_pk.required' => 'no pks harus diisi',
            'namafile.required' => 'jenis pks harus diisi',
            'namamitra.required' => 'nama mitra harus diisi',
            'tglmulai.required' => 'tglmulai harus diisi',
            'tglakhir.required' => 'tglakhir harus diisi',
            'file.required' => 'file belum di input',
            'file.mimes' => 'file yang di upload harus berbentuk .pdf'
        ]);


        $nm         = $request->file('file');

        //tgl mulai
        $hari       = substr($request->tglmulai,8,2);
        $bulan      = substr($request->tglmulai,5,2);
        $tahun      = substr($request->tglmulai,0,4);
        $arr        = array($hari,"/",$bulan,"/",$tahun);
        //tgl akhir
        $hari2       = substr($request->tglakhir,8,2);
        $bulan2      = substr($request->tglakhir,5,2);
        $tahun2      = substr($request->tglakhir,0,4);
        $arr2        = array($hari2,"/",$bulan2,"/",$tahun2);

        $arrnamefile        = array($hari,$bulan,$tahun);
        $datefile   = implode("",$arrnamefile);

        $datemulai       = $request->tglmulai;
        $dateakhir       = $request->tglakhir;


        $acak = $this->acak_string(6);
        $file   = $acak.".".$nm->getClientOriginalName();
        $pk = $this->pk->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_pk'         => $request->get('no_pk'),
            'namamitra'      => $request->get('namamitra'),
            'namafile'      => $request->get('namafile'),
            'tglmulai'       => $datemulai,
            'tglakhir'       => $dateakhir,
            'status'       => $request->get('status'),
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
       $pk = Pk::findOrFail($id);
       // dd($request->namafile);

       $pk->update($request->all());

        return $this->sendResponse($pk, 'Data PKS Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $pk = Pk::findOrFail($id);
       // dd($request->namabarang);
       $pk->update($request->no_pk);
       $pk->update($request->namafile);
       $pk->update($request->namamitra);

        return $this->sendResponse($pk, 'Data PKS Diubah!');
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
    function acak_string($panjang) {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter)-1);
            $string .= $karakter[$pos];
        }
        return $string;
    }

    public function filtertglmulai(Request $request)
    {
       // dd($request->all());
         $tglmulai = $request->tglmulai;
        //2023-02-01 s/d 2023-02-04
        //tgl mulai from
        $hari       = substr($request->tglmulai,8,2);
        $bulan      = substr($request->tglmulai,5,2);
        $tahun      = substr($request->tglmulai,0,4);
        $arr        = array($hari,"/",$bulan,"/",$tahun);
        $date1       = implode("",$arr);
        $fromtgl    = substr($tglmulai,0,10);
        //tgl mulai to
        $hari2       = substr($request->tglmulai,23,2);
        $bulan2      = substr($request->tglmulai,20,2);
        $tahun2      = substr($request->tglmulai,15,4);
        $arr2        = array($hari2,"/",$bulan2,"/",$tahun2);
        $date2       = implode("",$arr2);
        $totgl    = substr($tglmulai,15,10);


            $pk  = DB::table('pk')
            ->join('kode_kantors', 'pk.kantor_id', '=', 'kode_kantors.id')
            ->whereBetween('pk.tglmulai',[$fromtgl,$totgl])
            ->select('pk.id','pk.no_pk','pk.namamitra','pk.namafile','pk.tglmulai','pk.tglakhir','pk.status','pk.file',
            'pk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        return $this->sendResponse($pk, 'pk list');
    }

    public function filtertglakhir(Request $request)
    {
       // dd($request->all());
         $tglakhir = $request->tglakhir;
        //2023-02-01 s/d 2023-02-04
        //tgl mulai from

        $fromtgl    = substr($tglakhir,0,10);
        //tgl mulai to
        $totgl    = substr($tglakhir,15,10);


            $pk  = DB::table('pk')
            ->join('kode_kantors', 'pk.kantor_id', '=', 'kode_kantors.id')
            ->whereBetween('pk.tglakhir',[$fromtgl,$totgl])
            ->select('pk.id','pk.no_pk','pk.namamitra','pk.namafile','pk.tglmulai','pk.tglakhir','pk.status','pk.file',
            'pk.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        return $this->sendResponse($pk, 'pk list');
    }
}
