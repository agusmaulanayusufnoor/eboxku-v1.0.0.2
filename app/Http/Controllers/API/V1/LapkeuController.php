<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Lapkeu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LapkeuController extends BaseController
{
    protected $lapkeu = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Lapkeu $lapkeu)
    {
        $this->middleware('auth:api');
        $this->lapkeu= $lapkeu;
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
        //$lapkeu= $this->lapkeu->latest()->get();
        if($levelLogin === 'admin'){
            $lapkeu  = DB::table('lapkeu')
            ->join('kode_kantors', 'lapkeu.kantor_id', '=', 'kode_kantors.id')
            ->select('lapkeu.id','lapkeu.namafile','lapkeu.tanggal','lapkeu.file',
            'lapkeu.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $lapkeu  = DB::table('lapkeu')
            ->join('kode_kantors', 'lapkeu.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('lapkeu.id','lapkeu.namafile','lapkeu.tanggal','lapkeu.file',
            'lapkeu.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($lapkeu, 'lapkeu list');
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
            'file' => 'required|mimes:pdf'
        ],[
            'namafile.required' => 'nama file harus diisi',
            'tanggal.required' => 'tanggal harus diisi',
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
        $file   = "00".$request->kantor_id.".".$request->namafile.".".$acak.".".$nm->getClientOriginalName();
        $lapkeu = $this->lapkeu->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $request->tanggal,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/lapkeu', $file);

        return $this->sendResponse($lapkeu, 'File telah diupload...');
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
     * @param  \App\lapkeu  $lapkeu
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

        $lapkeu = $this->lapkeu->findOrFail($id);

        $lapkeu->delete();
        $file = public_path("file/lapkeu/".$lapkeu->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($lapkeu, 'File sudah dihapus!');
        }else{
            unlink("file/lapkeu/".$lapkeu->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($lapkeu, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $lapkeu = $this->lapkeu->findOrFail($id);
        $file = public_path("file/lapkeu/".$lapkeu->file);

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
