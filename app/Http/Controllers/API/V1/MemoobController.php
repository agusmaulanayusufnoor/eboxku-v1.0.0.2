<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Memoob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemoobController extends BaseController
{
    protected $memoob = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Memoob $memoob)
    {
        $this->middleware('auth:api');
        $this->memoob= $memoob;
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
        //$memoob= $this->memoob->latest()->get();
        if($levelLogin === 'admin'){
            $memoob  = DB::table('memoob')
            ->join('kode_kantors', 'memoob.kantor_id', '=', 'kode_kantors.id')
            ->select('memoob.id','memoob.namafile','memoob.tanggal','memoob.file',
            'memoob.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $memoob  = DB::table('memoob')
            ->join('kode_kantors', 'memoob.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('memoob.id','memoob.namafile','memoob.tanggal','memoob.file',
            'memoob.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($memoob, 'memoob list');
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
            'file' => 'required'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
            'file.required' => 'nama file harus nama kantor (ex: cab-kpo.xlsx)',
            'file.mimes' => 'file yang di upload harus berbentuk excel'
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
        $file   = "00".$request->kantor_id.".".$request->namafile.".".$acak.".".$nm->getClientOriginalName();
        $memoob = $this->memoob->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $request->tanggal,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/memoob', $file);

        return $this->sendResponse($memoob, 'File telah diupload...');
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
     * @param  \App\memoob  $memoob
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

        $memoob = $this->memoob->findOrFail($id);

        $memoob->delete();
        $file = public_path("file/memoob/".$memoob->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($memoob, 'File sudah dihapus!');
        }else{
            unlink("file/memoob/".$memoob->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($memoob, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $memoob = $this->memoob->findOrFail($id);
        $file = public_path("file/memoob/".$memoob->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
    public function filterkantor(Request $request)
    {
        //dd($request->all());



    //$id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$memoob= $this->memoob->latest()->get();
        if($levelLogin === 'admin'){
            $nama_kantor = $request->kantor_id;

            $memoob  = DB::table('memoob')
            ->join('kode_kantors', 'memoob.kantor_id', '=', 'kode_kantors.id')
            ->where('kode_kantors.nama_kantor',$nama_kantor)
            ->select('memoob.id','memoob.namafile','memoob.tanggal','memoob.file',
            'memoob.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($memoob, 'memoob list');
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
