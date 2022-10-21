<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KreditController extends BaseController
{
    protected $kredit = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Kredit $kredit)
    {
        $this->middleware('auth:api');
        $this->kredit= $kredit;
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
            $kredit  = DB::table('kredit')
            ->join('kode_kantors', 'kredit.kantor_id', '=', 'kode_kantors.id')
            ->select('kredit.id','kredit.no_rekening','kredit.namafile','kredit.tanggal','kredit.file',
            'kredit.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $kredit  = DB::table('kredit')
            ->join('kode_kantors', 'kredit.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('kredit.id','kredit.no_rekening','kredit.namafile','kredit.tanggal','kredit.file',
            'kredit.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($kredit, 'File kredit list');
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
            'no_rekening'  => 'required|unique:kredit',
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
        $kredit = $this->kredit->create([
            'kantor_id'     => $request->get('kantor_id'),
            'no_rekening'   => $request->get('no_rekening'),
            'namafile'      => $request->get('namafile'),
            'tanggal'       => $date,
            'file'          => $file,
        ]);
        $nm->move(public_path().'/file/kre', $file);

        return $this->sendResponse($kredit, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kredit  $kredit
     * @return \Illuminate\Http\Response
     */
    public function show(Kredit $kredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kredit  $kredit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kredit $kredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kredit  $kredit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $kredit = $this->kredit->findOrFail($id);

        $kredit->delete();
        $file = public_path("file/kre/".$kredit->file);
        if (! file_exists($file)){
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($kredit, 'File sudah dihapus!');
        }else{
            unlink("file/kre/".$kredit->file);
            //notify()->error("Berhasil Dihapus","File ".$databa->namafile."","topCenter");
        //session()->flash('hapus','file sudah dihapus');
        return $this->sendResponse($kredit, 'File sudah dihapus!');
        }

    }
    public function downloadfile($id)
    {
        $kredit = $this->kredit->findOrFail($id);
        $file = public_path("file/kre/".$kredit->file);

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
      $kredit  = DB::table('kredit')
      ->where('no_rekening', $norek)
      ->select('kredit.no_rekening')
      ->get();

      if(!$kredit->isEmpty()){
        return $this->sendResponse($kredit, 'adarek');
      }else{
        return $this->sendResponse($kredit, 'kosong');
      }

    }
}
