<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Pjkpph4ayat2;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Pjkpph4ayat2Controller extends BaseController
{
    protected $pjkpph4ayat2 = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjkpph4ayat2 $pjkpph4ayat2)
    {
        $this->middleware('auth:api');
        $this->pjkpph4ayat2= $pjkpph4ayat2;
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
        //$pjkpph4ayat2= $this->pjkpph4ayat2->latest()->get();
        if($levelLogin === 'admin'){
            $pjkpph4ayat2  = DB::table('pjkpph4ayat2')
            ->join('kode_kantors', 'pjkpph4ayat2.kantor_id', '=', 'kode_kantors.id')
            ->select('pjkpph4ayat2.id','pjkpph4ayat2.namafile','pjkpph4ayat2.tanggal','pjkpph4ayat2.file',
            'pjkpph4ayat2.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjkpph4ayat2  = DB::table('pjkpph4ayat2')
            ->join('kode_kantors', 'pjkpph4ayat2.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjkpph4ayat2.id','pjkpph4ayat2.namafile','pjkpph4ayat2.tanggal','pjkpph4ayat2.file',
            'pjkpph4ayat2.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjkpph4ayat2, 'pjkpph4ayat2 list');
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
        $pjkpph4ayat2 = $this->pjkpph4ayat2->create([
            'kantor_id'     => $request->get('kantor_id'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/pjkpph4ayat2', $file);

        return $this->sendResponse($pjkpph4ayat2, 'File telah diupload...');
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
     * @param  \App\pjkpph4ayat2  $pjkpph4ayat2
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

        $pjkpph4ayat2 = $this->pjkpph4ayat2->findOrFail($id);

        $pjkpph4ayat2->delete();
        $file = public_path("file/pjkpph4ayat2/".$pjkpph4ayat2->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($pjkpph4ayat2, 'File sudah dihapus!');
        }else{
            unlink("file/pjkpph4ayat2/".$pjkpph4ayat2->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($pjkpph4ayat2, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $pjkpph4ayat2 = $this->pjkpph4ayat2->findOrFail($id);
        $file = public_path("file/pjkpph4ayat2/".$pjkpph4ayat2->file);

        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        }else{

        return response()->download($file);
        }

    }
}
