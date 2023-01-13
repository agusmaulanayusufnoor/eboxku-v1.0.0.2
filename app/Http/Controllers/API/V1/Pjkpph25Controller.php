<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Pjkpph25;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Pjkpph25Controller extends BaseController
{
    protected $pjkpph25 = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjkpph25 $pjkpph25)
    {
        $this->middleware('auth:api');
        $this->pjkpph25= $pjkpph25;
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
        //$pjkpph25= $this->pjkpph25->latest()->get();
        if($levelLogin === 'admin'){
            $pjkpph25  = DB::table('pjkpph25')
            ->join('kode_kantors', 'pjkpph25.kantor_id', '=', 'kode_kantors.id')
            ->select('pjkpph25.id','pjkpph25.namafile','pjkpph25.tanggal','pjkpph25.file',
            'pjkpph25.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjkpph25  = DB::table('pjkpph25')
            ->join('kode_kantors', 'pjkpph25.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjkpph25.id','pjkpph25.namafile','pjkpph25.tanggal','pjkpph25.file',
            'pjkpph25.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjkpph25, 'pjkpph25 list');
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
        $pjkpph25 = $this->pjkpph25->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pjkpph25', $file);

        return $this->sendResponse($pjkpph25, 'File telah diupload...');
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
     * @param  \App\pjkpph25  $pjkpph25
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

        $pjkpph25 = $this->pjkpph25->findOrFail($id);

        $pjkpph25->delete();
        $file = public_path("file/pjkpph25/".$pjkpph25->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pjkpph25, 'File sudah dihapus!');
        }else{
            unlink("file/pjkpph25/".$pjkpph25->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pjkpph25, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pjkpph25 = $this->pjkpph25->findOrFail($id);
        $file = public_path("file/pjkpph25/".$pjkpph25->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
