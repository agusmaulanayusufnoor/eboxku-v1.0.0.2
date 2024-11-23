<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Jtpelayananpusat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JtpelayananpusatController extends BaseController
{
    protected $jtpelayananpusat = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Jtpelayananpusat $jtpelayananpusat)
    {
        $this->middleware('auth:api');
        $this->jtpelayananpusat= $jtpelayananpusat;
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
        //$jtpelayananpusat= $this->jtpelayananpusat->latest()->get();
        if($levelLogin === 'admin'){
            $jtpelayananpusat  = DB::table('jtpelayananpusat')
            ->join('kode_kantors', 'jtpelayananpusat.kantor_id', '=', 'kode_kantors.id')
            ->select('jtpelayananpusat.id','jtpelayananpusat.namafile','jtpelayananpusat.tanggal','jtpelayananpusat.file',
            'jtpelayananpusat.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $jtpelayananpusat  = DB::table('jtpelayananpusat')
            ->join('kode_kantors', 'jtpelayananpusat.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('jtpelayananpusat.id','jtpelayananpusat.namafile','jtpelayananpusat.tanggal','jtpelayananpusat.file',
            'jtpelayananpusat.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($jtpelayananpusat, 'Jtpelayananpusat list');
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
            'tanggal' => 'unique:jtpelayananpusat,tanggal',
            'file' => 'required|mimes:pdf'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
            'tanggal.unique' => 'tanggal sudah ada dalam data',
            'file.required' => 'nama file harus nama kantor (ex: file-transaksi.pdf)',
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
        $file   = "01020101.600324.OP001UN-A".".00".$request->kantor_id.".".$request->namafile.".".$acak.".".$nm->getClientOriginalName();
        $jtpelayananpusat = $this->jtpelayananpusat->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/transakuntingpusat', $file);

        return $this->sendResponse($jtpelayananpusat, 'File telah diupload...');
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
     * @param  \App\Jtpelayananpusat  $jtpelayananpusat
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

        $jtpelayananpusat = $this->jtpelayananpusat->findOrFail($id);

        $jtpelayananpusat->delete();
        $file = public_path("file/transakuntingpusat/".$jtpelayananpusat->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($jtpelayananpusat, 'File sudah dihapus!');
        }else{
            unlink("file/transakuntingpusat/".$jtpelayananpusat->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($jtpelayananpusat, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $jtpelayananpusat = $this->jtpelayananpusat->findOrFail($id);
        $file = public_path("file/transakuntingpusat/".$jtpelayananpusat->file);

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
}
