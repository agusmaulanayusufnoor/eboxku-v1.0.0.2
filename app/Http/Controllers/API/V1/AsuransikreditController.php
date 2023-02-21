<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Asuransikredit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsuransikreditController extends BaseController
{
    protected $asuransikredit = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Asuransikredit $asuransikredit)
    {
        $this->middleware('auth:api');
        $this->asuransikredit= $asuransikredit;
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
        //$asuransikredit= $this->asuransikredit->latest()->get();
        if($levelLogin === 'admin'){
            $asuransikredit  = DB::table('asuransikredit')
            ->join('kode_kantors', 'asuransikredit.kantor_id', '=', 'kode_kantors.id')
            ->select('asuransikredit.id','asuransikredit.namafile','asuransikredit.tanggal','asuransikredit.file',
            'asuransikredit.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $asuransikredit  = DB::table('asuransikredit')
            ->join('kode_kantors', 'asuransikredit.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('asuransikredit.id','asuransikredit.namafile','asuransikredit.tanggal','asuransikredit.file',
            'asuransikredit.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($asuransikredit, 'asuransikredit list');
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
        $asuransikredit = $this->asuransikredit->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $request->tanggal,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/asuransikredit', $file);

        return $this->sendResponse($asuransikredit, 'File telah diupload...');
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
     * @param  \App\asuransikredit  $asuransikredit
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

        $asuransikredit = $this->asuransikredit->findOrFail($id);

        $asuransikredit->delete();
        $file = public_path("file/asuransikredit/".$asuransikredit->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($asuransikredit, 'File sudah dihapus!');
        }else{
            unlink("file/asuransikredit/".$asuransikredit->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($asuransikredit, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $asuransikredit = $this->asuransikredit->findOrFail($id);
        $file = public_path("file/asuransikredit/".$asuransikredit->file);

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
       //$asuransikredit= $this->asuransikredit->latest()->get();
        if($levelLogin === 'admin'){
            $nama_kantor = $request->kantor_id;

            $asuransikredit  = DB::table('asuransikredit')
            ->join('kode_kantors', 'asuransikredit.kantor_id', '=', 'kode_kantors.id')
            ->where('kode_kantors.nama_kantor',$nama_kantor)
            ->select('asuransikredit.id','asuransikredit.namafile','asuransikredit.tanggal','asuransikredit.file',
            'asuransikredit.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($asuransikredit, 'asuransikredit list');
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
