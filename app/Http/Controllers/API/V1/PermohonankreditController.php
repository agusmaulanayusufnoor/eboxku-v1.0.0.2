<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Permohonankredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PermohonankreditController extends BaseController
{
    protected $permohonankredit = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Permohonankredit $permohonankredit)
    {
        $this->middleware('auth:api');
        $this->permohonankredit = $permohonankredit;
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
            $permohonankredit  = DB::table('permohonankredit')
                ->join('kode_kantors', 'permohonankredit.kantor_id', '=', 'kode_kantors.id')
                ->join('statuspermohonan', 'permohonankredit.status_id', '=', 'statuspermohonan.id')
                ->select(
                    'permohonankredit.id',
                    'permohonankredit.no_ktp',
                    'permohonankredit.no_rekening',
                    'permohonankredit.namafile',
                    'permohonankredit.tgl_permohonan',
                    'permohonankredit.tgl_setujutolak',
                    'permohonankredit.tgl_pencairan',
                    'permohonankredit.file',
                    'permohonankredit.file_disetujui',
                    'permohonankredit.file_spk',
                    'permohonankredit.kantor_id',
                    'kode_kantors.nama_kantor',
                    'statuspermohonan.statuspermohonan'
                )
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $permohonankredit  = DB::table('permohonankredit')
                ->join('kode_kantors', 'permohonankredit.kantor_id', '=', 'kode_kantors.id')
                ->join('statuspermohonan', 'permohonankredit.status_id', '=', 'statuspermohonan.id')
                ->where('kantor_id', $id_kantor)
                ->select(
                    'permohonankredit.id',
                    'permohonankredit.no_ktp',
                    'permohonankredit.no_rekening',
                    'permohonankredit.namafile',
                    'permohonankredit.tgl_permohonan',
                    'permohonankredit.tgl_setujutolak',
                    'permohonankredit.tgl_pencairan',
                    'permohonankredit.file',
                    'permohonankredit.file_disetujui',
                    'permohonankredit.file_spk',
                    'permohonankredit.kantor_id',
                    'kode_kantors.nama_kantor',
                    'statuspermohonan.statuspermohonan'
                )
                ->orderBy('id', 'desc')
                ->get();
        }

        return $this->sendResponse($permohonankredit, 'File permohonankredit list');
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
            'no_ktp'  => 'required|unique:permohonankredit',
            'namafile'     => 'required',
            'tgl_permohonan' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute . ' harus diisi.');
                }
            }],
            'file'         => 'required|mimes:pdf'
        ], [
            'no_ktp.unique' => 'no ktp sudah ada dalam data',
            'no_ktp.required' => 'no ktp harus diisi',
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
        $file   = "00" . $request->kantor_id . "." . $request->no_ktp. "." . $request->namafile . "." . $acak . "." . $nm->getClientOriginalName();
        $permohonankredit = $this->permohonankredit->create([
            'kantor_id'         => $request->get('kantor_id'),
            'no_ktp'            => $request->get('no_ktp'),
            'no_rekening'       => $request->get('no_rekening'),
            'namafile'          => $request->get('namafile'),
            'tgl_permohonan'    => $date,
            'file'              => $file,
            'status_id'         => 1,
        ]);
        $nm->move(public_path() . '/file/permohonankre', $file);

        return $this->sendResponse($permohonankredit, 'File telah diupload...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permohonankredit  $permohonankredit
     * @return \Illuminate\Http\Response
     */
    public function show(Permohonankredit $permohonankredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permohonankredit  $permohonankredit
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $id)
    {
        $permohonankredit = Permohonankredit::findOrFail($id);
        //dd($request->get('jml_stok_awal'));

        // $stock->update($request->all());

        return $this->sendResponse($permohonankredit, 'Data User Diubah!');
    }
    public function update(Request $request, $id)
    {
        // $permohonankredit = Permohonankredit::findOrFail($id);
        // dd($request->all());


        $nm         = $request->file('file_disetujui');
        $nmspk        = $request->file('file_spk');

        $hari       = substr($request->tgl_setujutolak, 8, 2);
        $bulan      = substr($request->tgl_setujutolak, 5, 2);
        $tahun      = substr($request->tgl_setujutolak, 0, 4);
        $arr        = array($hari, "/", $bulan, "/", $tahun);

        $harispk       = substr($request->tgl_pencairan, 8, 2);
        $bulanspk      = substr($request->tgl_pencairan, 5, 2);
        $tahunspk      = substr($request->tgl_pencairan, 0, 4);
        $arrspk        = array($harispk, "/", $bulanspk, "/", $tahunspk);

        $date       = implode("", $arr);
        $datespk       = implode("", $arrspk);
        $acak = $this->acak_string(7);

        // $permohonankredit = $this->permohonankredit->update([

        //     'tgl_setujutolak'    => $date,
        //     'file_disetujui'              => $file,
        //     'status_id'         => $request->status_id,
        // ]);
        //  $permohonankredit->update($request->all());
        $levelLogin = Auth::user()->type;

        if ($levelLogin === 'admin' || $levelLogin === 'bisnis') {
            $filedisetujui   = "[disetujui]." . $acak . "." . $request->no_ktp . "." . $request->namafile . ".pdf";
            $permohonankredit = DB::table('permohonankredit')->where('id', $id)->update([
                'tgl_setujutolak'   => $date,
                'file_disetujui'    => $filedisetujui,
                'status_id'         => $request->status_id,
            ]);
        } else {

                $filespk   = "[selesai]." . $acak . "." . $request->no_ktp . "." . $request->namafile . ".pdf";
                $permohonankredit = DB::table('permohonankredit')->where('id', $id)->update([
                'no_rekening'       => $request->no_rekening,
                'tgl_pencairan'     => $datespk,
                'file_spk'          => $filespk,
                'status_id'         => $request->status_id,
                ]);


        }
        // $permohonankredit = DB::table('permohonankredit')->where('id', $id)->update([
        //     'tgl_setujutolak'    => $date,
        //     'file_disetujui'              => $file,
        //     'status_id'         => $request->status_id,
        // ]);
        if ($request->file('file_disetujui')) {
            $nm->move(public_path() . '/file/permohonankre', $filedisetujui);
        }

        if ($request->file('file_spk')) {
            $nmspk->move(public_path() . '/file/permohonankre', $filespk);
        }
        return $this->sendResponse($permohonankredit, 'Data Permohonan Kredit Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permohonankredit  $permohonankredit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $permohonankredit = $this->permohonankredit->findOrFail($id);

        $permohonankredit->delete();
        $filepermohonan = "file/permohonankre/" . $permohonankredit->file;
        $file_disetujui = "file/permohonankre/" . $permohonankredit->file_disetujui;
        $file_spk = "file/permohonankre/" . $permohonankredit->file_spk;

        // $files = [$filepermohonan,$file_disetujui,$file_spk];
        // foreach ($files as $file) {
        //     while ($data=file_exists(public_path($file))) {
        //         unlink(public_path($file));
        //         if ($data==true){

        //             return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        //         }else{
        //             return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        //         }


        //        // return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        //     }

        // }
        // if (File::exists($file)) {
        //     //session()->flash('hapus','file sudah dihapus');
        //     unlink("file/permohonankre/" . $permohonankredit->file);
        //     return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        // }

        // if (File::exists($file_disetujui)){
        //     unlink("file/permohonankre/" . $permohonankredit->file_disetujui);

        //    // return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        // }

      //  return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
         if ($permohonankredit->file<>'') {
            unlink("file/permohonankre/" . $permohonankredit->file);
            if ($permohonankredit->file_disetujui<>'') {
                unlink("file/permohonankre/" . $permohonankredit->file_disetujui);
                //return $this->sendResponse($permohonankredit, 'ada file!');
                if ($permohonankredit->file_spk<>'') {
                    unlink("file/permohonankre/" . $permohonankredit->file_spk);
                    return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
                } else {

                    return $this->sendResponse($permohonankredit, 'tidak ada file spk!');
                }
            } else {
                return $this->sendResponse($permohonankredit, 'tidak ada file disetujui');

            }
        } else {
            return $this->sendResponse($permohonankredit, 'File sudah dihapus!');

        }



        // if (!File::exists($file_spk)) {
        //     return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        // } else {
        //     unlink("file/permohonankre/" . $permohonankredit->file_spk);
        //     return $this->sendResponse($permohonankredit, 'File sudah dihapus!');
        // }
    }
    public function downloadfile($id)
    {
        $permohonankredit = $this->permohonankredit->findOrFail($id);
        $file = public_path("file/permohonankre/" . $permohonankredit->file);

        if (!file_exists($file)) {
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        } else {

            return response()->download($file);
        }
    }
    public function downloadfiledisetujui($id)
    {
        $permohonankredit = $this->permohonankredit->findOrFail($id);
        $file_setuju = public_path("file/permohonankre/" . $permohonankredit->file_disetujui);

        if (!file_exists($file_setuju)) {
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file_setuju, 'File tidak ditemukan!');
        } else {

            return response()->download($file_setuju);
        }
    }
    public function downloadfilespk($id)
    {
        $permohonankredit = $this->permohonankredit->findOrFail($id);
        $file = public_path("file/permohonankre/" . $permohonankredit->file_spk);

        if (!file_exists($file)) {
            //session()->flash('hapus','file sudah dihapus');
            return $this->sendResponse($file, 'File tidak ditemukan!');
        } else {

            return response()->download($file);
        }
    }
    public function ceknorek(Request $request)
    {
        $norek = $request->no_ktp;
        $permohonankredit  = DB::table('permohonankredit')
            ->where('no_ktp', $norek)
            ->select('permohonankredit.no_ktp')
            ->get();

        if (!$permohonankredit->isEmpty()) {
            return $this->sendResponse($permohonankredit, 'adarek');
        } else {
            return $this->sendResponse($permohonankredit, 'kosong');
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
