<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Permoperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PermoperasionalController extends BaseController
{
    protected $permoperasional = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Permoperasional $permoperasional)
    {
        $this->middleware('auth:api');
        $this->permoperasional = $permoperasional;
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

        if ($levelLogin === 'admin' || $levelLogin === 'bisnis') {
            $permoperasional  = DB::table('permoperasional')
                ->join('kode_kantors', 'permoperasional.kantor_id', '=', 'kode_kantors.id')
                ->join('statuspermohonan', 'permoperasional.status_id', '=', 'statuspermohonan.id')
                ->select(
                    'permoperasional.id',
                    'permoperasional.namafile',
                    'permoperasional.tgl_permohonan',
                    'permoperasional.tgl_setujutolak',
                    'permoperasional.tgl_acc',
                    'permoperasional.file',
                    'permoperasional.kantor_id',
                    'kode_kantors.nama_kantor',
                    'statuspermohonan.statuspermohonan'
                )
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $permoperasional  = DB::table('permoperasional')
                ->join('kode_kantors', 'permoperasional.kantor_id', '=', 'kode_kantors.id')
                ->join('statuspermohonan', 'permoperasional.status_id', '=', 'statuspermohonan.id')
                ->where('kantor_id', $id_kantor)
                ->select(
                    'permoperasional.id',
                    'permoperasional.namafile',
                    'permoperasional.tgl_permohonan',
                    'permoperasional.tgl_setujutolak',
                    'permoperasional.tgl_acc',
                    'permoperasional.file',
                    'permoperasional.kantor_id',
                    'kode_kantors.nama_kantor',
                    'statuspermohonan.statuspermohonan'
                )
                ->orderBy('id', 'desc')
                ->get();
        }

        return $this->sendResponse($permoperasional, 'File permoperasional list');
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
            'namafile'     => 'required',
            'tgl_permohonan' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute . ' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:pdf'
        ], [
            'namafile.required' => 'nama file harus diisi',
            'tgl_permohonan.required' => 'tanggal harus diisi',
            'file.required' => 'nama file harus nama nasabah',
            'file.mimes' => 'file yang di upload harus berbentuk .pdf'
        ]);


        $nm         = $request->file('file');

        $hari       = substr($request->tgl_permohonan, 8, 2);
        $bulan      = substr($request->tgl_permohonan, 5, 2);
        $tahun      = substr($request->tgl_permohonan, 0, 4);
        $arr        = array($hari, "/", $bulan, "/", $tahun);
        $arrnamefile        = array($hari, $bulan, $tahun);
        $datefile   = implode("", $arrnamefile);

        $date       = implode("", $arr);
        $acak = $this->acak_string(5);
        $file   = "00" . $request->kantor_id . "."  . $request->namafile . "." . $acak . "." . $nm->getClientOriginalName();
        $permoperasional = $this->permoperasional->create([
            'kantor_id'         => $request->get('kantor_id'),
            'namafile'          => $request->get('namafile'),
            'tgl_permohonan'    => $date,
            'file'              => $file,
            'status_id'         => 5,
        ]);
        $nm->move(public_path() . '/file/permoperasional', $file);

        return $this->sendResponse($permoperasional, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permoperasional  $permoperasional
     * @return \Illuminate\Http\Response
     */
    public function show(Permoperasional $permoperasional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permoperasional  $permoperasional
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $id)
    {
        $permoperasional = Permoperasional::findOrFail($id);
        //dd($request->get('jml_stok_awal'));

        // $stock->update($request->all());

        return $this->sendResponse($permoperasional, 'Data User Diubah!');
    }
    public function update(Request $request, $id)
    {
        $hari       = substr($request->tgl_setujutolak, 8, 2);
        $bulan      = substr($request->tgl_setujutolak, 5, 2);
        $tahun      = substr($request->tgl_setujutolak, 0, 4);
        $arr        = array($hari, "/", $bulan, "/", $tahun);

        $hariacc       = substr($request->tgl_acc, 8, 2);
        $bulanacc      = substr($request->tgl_acc, 5, 2);
        $tahunacc      = substr($request->tgl_acc, 0, 4);
        $arracc       = array($hariacc, "/", $bulanacc, "/", $tahunacc);

        $date       = implode("", $arr);
        $dateacc       = implode("", $arracc);
         //$permoperasional = Permoperasional::findOrFail($id);
        // dd($request->all());


        // $permoperasional->update($request->all());
        $levelLogin = Auth::user()->otorisator;
        //dd(Auth::user());
        if ($levelLogin === 1) {
            $permoperasional = DB::table('permoperasional')->where('id', $id)->update([
                'tgl_setujutolak'   => $date,
                'status_id'         => $request->status_id,
            ]);
        }else{
            $permoperasional = DB::table('permoperasional')->where('id', $id)->update([
                'tgl_acc'   => $dateacc,
                'status_id'         => $request->status_id,
            ]);
        }

        return $this->sendResponse($permoperasional, 'Data Permohonan Kredit Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permoperasional  $permoperasional
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $permoperasional = $this->permoperasional->findOrFail($id);

        $permoperasional->delete();
        unlink("file/permoperasional/" . $permoperasional->file);
        return $this->sendResponse($permoperasional, 'File sudah dihapus!');

    }
    public function downloadfile($id)
    {
        $permoperasional = $this->permoperasional->findOrFail($id);
        $file = public_path("file/permoperasional/" . $permoperasional->file);

        if (!file_exists($file)) {
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        } else {

            return response()->download($file);
        }
    }

    function acak_string($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter[$pos];
        }
        return $string;
    }
}
