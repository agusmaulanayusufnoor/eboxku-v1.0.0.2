<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Asuransi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsuransiController extends BaseController
{
    protected $asuransi = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Asuransi $asuransi)
    {
        $this->middleware('auth:api');
        $this->asuransi= $asuransi;
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
        //$asuransi= $this->asuransi->latest()->get();
        if($levelLogin === 'admin'){
            $asuransi  = DB::table('asuransi')
            ->join('kode_kantors', 'asuransi.kantor_id', '=', 'kode_kantors.id')
            ->select('asuransi.id','asuransi.namafile','asuransi.tanggal','asuransi.file',
            'asuransi.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $asuransi  = DB::table('asuransi')
            ->join('kode_kantors', 'asuransi.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('asuransi.id','asuransi.namafile','asuransi.tanggal','asuransi.file',
            'asuransi.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($asuransi, 'asuransi list');
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

        $file   = "00".$request->kantor_id.".".$request->namafile.".".$datefile.".".$nm->getClientOriginalName();
        $asuransi = $this->asuransi->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/asuransi', $file);

        return $this->sendResponse($asuransi, 'File telah diupload...');
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
     * @param  \App\asuransi  $asuransi
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

        $asuransi = $this->asuransi->findOrFail($id);

        $asuransi->delete();
        $file = public_path("file/asuransi/".$asuransi->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($asuransi, 'File sudah dihapus!');
        }else{
            unlink("file/asuransi/".$asuransi->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($asuransi, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $asuransi = $this->asuransi->findOrFail($id);
        $file = public_path("file/asuransi/".$asuransi->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
