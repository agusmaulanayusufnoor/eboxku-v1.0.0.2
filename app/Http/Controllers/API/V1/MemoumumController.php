<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Memoumum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemoumumController extends BaseController
{
    protected $memoumum = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Memoumum $memoumum)
    {
        $this->middleware('auth:api');
        $this->memoumum= $memoumum;
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
            $memoumum  = DB::table('memoumum')
            ->join('kode_kantors', 'memoumum.kantor_id', '=', 'kode_kantors.id')
            ->select('memoumum.id','memoumum.jenis','memoumum.no_memo','memoumum.namafile','memoumum.tanggal','memoumum.file',
            'memoumum.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $memoumum  = DB::table('memoumum')
            ->join('kode_kantors', 'memoumum.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('memoumum.id','memoumum.jenis','memoumum.no_memo','memoumum.namafile','memoumum.tanggal','memoumum.file',
            'memoumum.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($memoumum, 'File Rekening Koran ABA list');
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
            'no_memo'  => 'required',
            'namafile'     => 'required',
            'tanggal' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:pdf'
        ],[
            'no_memo.unique' => 'no rekening sudah ada dalam data',
            'no_memo.required' => 'no rekening harus diisi',
            'jenis.required' => 'tanggal harus dipilih',
            'tanggal.required' => 'tanggal harus diisi',
            'namafile.required' => 'nama file harus diisi',
            'file.required' => 'nama file harus nama bank (ex: brilink.pdf)',
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
        $file   = "00".$request->kantor_id.".".$request->no_memo.".".$request->namafile.".".$acak.".".$nm->getClientOriginalName();
        $memoumum = $this->memoumum->create([
            'kantor_id'     => $request->get('kantor_id'),
            'jenis'         => $request->get('jenis'),
            'no_memo'   => $request->get('no_memo'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $request->tanggal,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/aba', $file);

        return $this->sendResponse($memoumum, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memoumum  $memoumum
     * @return \Illuminate\Http\Response
     */
    public function show(Memoumum $memoumum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memoumum  $memoumum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memoumum $memoumum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memoumum  $memoumum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $memoumum = $this->memoumum->findOrFail($id);

        $memoumum->delete();
        $file = public_path("file/aba/".$memoumum->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($memoumum, 'File sudah dihapus!');
        }else{
            unlink("file/aba/".$memoumum->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($memoumum, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $memoumum = $this->memoumum->findOrFail($id);
        $file = public_path("file/aba/".$memoumum->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function ceknorek(Request $request)
    {
      $norek = $request->no_memo;
      $memoumum  = DB::table('memoumum')
      ->where('no_memo', $norek)
      ->select('memoumum.no_memo')
      ->get();

      if(!$memoumum->isEmpty()){
        return $this->sendResponse($memoumum, 'adarek');
      }else{
        return $this->sendResponse($memoumum, 'kosong');
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

    public function filterkantor(Request $request)
    {
        //dd($request->all());



    //$id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$memoumum= $this->memoumum->latest()->get();
        if($levelLogin === 'admin'){
            $nama_kantor = $request->kantor_id;

            $memoumum  = DB::table('memoumum')
            ->join('kode_kantors', 'memoumum.kantor_id', '=', 'kode_kantors.id')
            ->where('kode_kantors.nama_kantor',$nama_kantor)
            ->select('memoumum.id','memoumum.jenis','memoumum.no_memo','memoumum.namafile','memoumum.tanggal','memoumum.file',
            'memoumum.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($memoumum, 'memoumum list');
    }
    public function filterjenis(Request $request)
    {
        //dd($request->all());
         $jenis = $request->jenis;


    //$id_kantor  = Auth::user()->kantor_id;
      // $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$memoumum= $this->memoumum->latest()->get();
        //if($levelLogin === 'admin'){


            $memoumum  = DB::table('memoumum')
            ->join('kode_kantors', 'memoumum.kantor_id', '=', 'kode_kantors.id')
            ->where('memoumum.jenis',$jenis)
            ->select('memoumum.id','memoumum.jenis','memoumum.no_memo','memoumum.namafile','memoumum.tanggal','memoumum.file',
            'memoumum.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        //}
        return $this->sendResponse($memoumum, 'memoumum list');
    }
}
