<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Permbisnis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PermbisnisController extends BaseController
{
    protected $permbisnis = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Permbisnis $permbisnis)
    {
        $this->middleware('auth:api');
        $this->permbisnis = $permbisnis;
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
            $permbisnis  = DB::table('permbisnis')
                ->join('kode_kantors', 'permbisnis.kantor_id', '=', 'kode_kantors.id')
                ->join('statuspermohonan', 'permbisnis.status_id', '=', 'statuspermohonan.id')
                ->select(
                    'permbisnis.id',
                    'permbisnis.namafile',
                    'permbisnis.tgl_permohonan',
                    'permbisnis.tgl_setujutolak',
                    'permbisnis.tgl_acc',
                    'permbisnis.tgl_selesai',
                    'permbisnis.file',
                    'permbisnis.file_memo',
                    'permbisnis.kantor_id',
                    'kode_kantors.nama_kantor',
                    'statuspermohonan.statuspermohonan'
                )
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $permbisnis  = DB::table('permbisnis')
                ->join('kode_kantors', 'permbisnis.kantor_id', '=', 'kode_kantors.id')
                ->join('statuspermohonan', 'permbisnis.status_id', '=', 'statuspermohonan.id')
                ->where('kantor_id', $id_kantor)
                ->select(
                    'permbisnis.id',
                    'permbisnis.namafile',
                    'permbisnis.tgl_permohonan',
                    'permbisnis.tgl_setujutolak',
                    'permbisnis.tgl_acc',
                    'permbisnis.tgl_selesai',
                    'permbisnis.file',
                    'permbisnis.file_memo',
                    'permbisnis.kantor_id',
                    'kode_kantors.nama_kantor',
                    'statuspermohonan.statuspermohonan'
                )
                ->orderBy('id', 'desc')
                ->get();
        }

        return $this->sendResponse($permbisnis, 'File permbisnis list');
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
        $permbisnis = $this->permbisnis->create([
            'kantor_id'         => $request->get('kantor_id'),
            'namafile'          => $request->get('namafile'),
            'tgl_permohonan'    => $date,
            'file'              => $file,
            'status_id'         => 5,
        ]);
        $nm->move(public_path() . '/file/permbisnis', $file);

        return $this->sendResponse($permbisnis, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permbisnis  $permbisnis
     * @return \Illuminate\Http\Response
     */
    public function show(Permbisnis $permbisnis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permbisnis  $permbisnis
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $id)
    {
        $permbisnis = Permbisnis::findOrFail($id);
        //dd($request->get('jml_stok_awal'));

        // $stock->update($request->all());

        return $this->sendResponse($permbisnis, 'Data User Diubah!');
    }
    public function update(Request $request, $id)
    {
        $nm         = $request->file('file_memo');
        $hari       = substr($request->tgl_selesai, 8, 2);
        $bulan      = substr($request->tgl_selesai, 5, 2);
        $tahun      = substr($request->tgl_selesai, 0, 4);
        $arr        = array($hari, "/", $bulan, "/", $tahun);

        $hariacc       = substr($request->tgl_acc, 8, 2);
        $bulanacc      = substr($request->tgl_acc, 5, 2);
        $tahunacc      = substr($request->tgl_acc, 0, 4);
        $arracc       = array($hariacc, "/", $bulanacc, "/", $tahunacc);

        $harimemo       = substr($request->tgl_setujutolak, 8, 2);
        $bulanmemo      = substr($request->tgl_setujutolak, 5, 2);
        $tahunmemo      = substr($request->tgl_setujutolak, 0, 4);
        $arrmemo       = array($harimemo, "/", $bulanmemo, "/", $tahunmemo);

        $dateselesai       = implode("", $arr);
        $dateacc       = implode("", $arracc);
        $datememo       = implode("", $arrmemo);
         //$permbisnis = Permbisnis::findOrFail($id);
        // dd($request->all());
        $acak = $this->acak_string(5);

        // $permbisnis->update($request->all());
        $levelLogin = Auth::user()->otorisator;
        $typeLogin = Auth::user()->type;
        //dd(Auth::user());
        if (($typeLogin === 'bisnis')){
            $file_memo   = "[memo]-00" . $request->kantor_id . "."  . $request->namafile . "." . $acak . "." . $nm->getClientOriginalName();
            $permbisnis = DB::table('permbisnis')->where('id', $id)->update([
                'tgl_setujutolak'   => $datememo,
                'status_id'         => $request->status_id,
                'file_memo'         => $file_memo,
            ]);
            $nm->move(public_path() . '/file/permbisnis', $file_memo);
            return $this->sendResponse($permbisnis, 'Data Permohonan Diubah!');
        } else if (($typeLogin === 'admin') and ($levelLogin===1)) {
            $permbisnis = DB::table('permbisnis')->where('id', $id)->update([
                'tgl_acc'   => $dateacc,
                'status_id'         => $request->status_id,
            ]);
            return $this->sendResponse($permbisnis, 'Data Permohonan Diubah!');
        }
        else{
            $cekstatus = Permbisnis::findOrFail($id);
            $status = $cekstatus->status_id;
             if ($status === 7){
                $permbisnis = DB::table('permbisnis')->where('id', $id)->update([
                    'tgl_selesai'   => $dateselesai,
                    'status_id'         => $request->status_id,
                ]);
                return $this->sendResponse($permbisnis, 'Data Permohonan Diubah!');

            } else {
                return $this->sendResponse($status,'Status Belum Disetujui Pindiv Operasional');
            }

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permbisnis  $permbisnis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $permbisnis = $this->permbisnis->findOrFail($id);

        $permbisnis->delete();
       // unlink("file/permbisnis/" . $permbisnis->file);
       // return $this->sendResponse($permbisnis, 'File sudah dihapus!');


        if ($permbisnis->file<>'') {
            unlink("file/permbisnis/" . $permbisnis->file);
            if ($permbisnis->file_memo<>'') {
                unlink("file/permbisnis/" . $permbisnis->file_memo);
                return $this->sendResponse($permbisnis, 'ada file!');

            } else {
                return $this->sendResponse($permbisnis, 'tidak ada file disetujui');

            }
        } else {
            return $this->sendResponse($permbisnis, 'File sudah dihapus!');

        }



    }
    public function downloadfile($id)
    {
        $permbisnis = $this->permbisnis->findOrFail($id);
        $file = public_path("file/permbisnis/" . $permbisnis->file);

        if (!file_exists($file)) {
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        } else {

            return response()->download($file);
        }
    }
    public function downloadfilememo($id)
    {
        $permbisnis = $this->permbisnis->findOrFail($id);
        $file = public_path("file/permbisnis/" . $permbisnis->file_memo);

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
