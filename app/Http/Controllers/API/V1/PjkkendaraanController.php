<?php

namespace App\Http\Controllers\API\V1;


use App\Models\Pjkkendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PjkkendaraanController extends BaseController
{
    protected $pjkkendaraan = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pjkkendaraan $pjkkendaraan)
    {
        $this->middleware('auth:api');
        $this->pjkkendaraan= $pjkkendaraan;
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
            $pjkkendaraan  = DB::table('pjkkendaraan')
            ->join('kode_kantors', 'pjkkendaraan.kantor_id', '=', 'kode_kantors.id')
            ->select('pjkkendaraan.id','pjkkendaraan.nopol','pjkkendaraan.tgl_habis_stnk',
            'pjkkendaraan.tgl_pajak_tahunan','pjkkendaraan.nilai_pajak',
            'pjkkendaraan.pemegang_kendaraan','pjkkendaraan.status_bayar','pjkkendaraan.keterangan',
            'pjkkendaraan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }else{
            $pjkkendaraan  = DB::table('pjkkendaraan')
            ->join('kode_kantors', 'pjkkendaraan.kantor_id', '=', 'kode_kantors.id')
            ->where('kantor_id', $id_kantor)
            ->select('pjkkendaraan.id','pjkkendaraan.nopol','pjkkendaraan.tgl_habis_stnk',
            'pjkkendaraan.tgl_pajak_tahunan','pjkkendaraan.nilai_pajak',
            'pjkkendaraan.pemegang_kendaraan','pjkkendaraan.status_bayar','pjkkendaraan.keterangan',
            'pjkkendaraan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();
        }

        return $this->sendResponse($pjkkendaraan, 'File Rekening Koran ABA list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'nopol'  => 'required',
            'nilai_pajak'     => 'required',
            'status_bayar'     => 'required',
            'tgl_habis_stnk' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
            'tgl_pajak_tahunan' => ['required', function ($attribute, $value, $fail) {
                if ($value === 'null') {
                    $fail($attribute.' harus diisi.');
                }
            }],
        ],[
            'nopol.unique' => 'no polisi sudah ada dalam data',
            'nopol.required' => 'no polisi harus diisi',
            'tgl_habis_stnk.required' => 'tanggal habis stnk harus diisi',
            'tgl_pajak_tahunan.required' => 'tanggal pajak tahunan harus diisi',
            'nilai_pajak.required' => 'nilai pajak harus diisi',
            'status_bayar.required' => 'status bayar harus diisi'
        ]);
        $data = [
            'kantor_id'             => $request->get('kantor_id'),
                'nopol'                 => $request->get('nopol'),
                'tgl_habis_stnk'        => $request->get('tgl_habis_stnk'),
                'tgl_pajak_tahunan'     => $request->get('tgl_pajak_tahunan'),
                'nilai_pajak'           => $request->get('nilai_pajak'),
                'status_bayar'          => $request->get('status_bayar'),
        ];
        if(($request->get('keterangan')==='null')){
            $data['keterangan'] = '';
        }else{
            $data['keterangan']         = $request->get('keterangan');
        }

        if(($request->get('pemegang_kendaraan')==='null')){
            $data['pemegang_kendaraan'] = '';
        }else{
            $data['pemegang_kendaraan'] = $request->get('pemegang_kendaraan');
        }

            $pjkkendaraan = $this->pjkkendaraan->create($data);

        return $this->sendResponse($pjkkendaraan, 'Data Disimpan...!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pjkkendaraan  $pjkkendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Pjkkendaraan $pjkkendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pjkkendaraan  $pjkkendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pjkkendaraan = Pjkkendaraan::findOrFail($id);
    $pjkkendaraan->update($request->all());
        return $this->sendResponse($pjkkendaraan, 'Data Pajak Diubah!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pjkkendaraan  $pjkkendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $pjkkendaraan = $this->pjkkendaraan->findOrFail($id);

        $pjkkendaraan->delete();
        return $this->sendResponse($pjkkendaraan, 'Data sudah dihapus!');


    }

    public function ceknorek(Request $request)
    {
      $nopol = $request->nopol;
      $pjkkendaraan  = DB::table('pjkkendaraan')
      ->where('nopol', $nopol)
      ->select('pjkkendaraan.nopol')
      ->get();

      if(!$pjkkendaraan->isEmpty()){
        return $this->sendResponse($pjkkendaraan, 'adarek');
      }else{
        return $this->sendResponse($pjkkendaraan, 'kosong');
      }

    }

    public function filterkantor(Request $request)
    {
        //dd($request->all());

    //$id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$pjkkendaraan= $this->pjkkendaraan->latest()->get();
        if($levelLogin === 'admin'){
            $nama_kantor = $request->kantor_id;

            $pjkkendaraan  = DB::table('pjkkendaraan')
            ->join('kode_kantors', 'pjkkendaraan.kantor_id', '=', 'kode_kantors.id')
            ->where('kode_kantors.nama_kantor',$nama_kantor)
            ->select('pjkkendaraan.id','pjkkendaraan.nopol','pjkkendaraan.tgl_habis_stnk',
            'pjkkendaraan.tgl_pajak_tahunan','pjkkendaraan.nilai_pajak',
            'pjkkendaraan.pemegang_kendaraan','pjkkendaraan.status_bayar','pjkkendaraan.keterangan',
            'pjkkendaraan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        }
        return $this->sendResponse($pjkkendaraan, 'pjkkendaraan list');
    }//endfilterkantor

    public function filterstatus(Request $request)
    {
        //dd($request->all());
         $status_bayar = $request->status_bayar;


    //$id_kantor  = Auth::user()->kantor_id;
      // $levelLogin = Auth::user()->type;
       // $stock=stock::all();
       //$pjkkendaraan= $this->pjkkendaraan->latest()->get();
        //if($levelLogin === 'admin'){


            $pjkkendaraan  = DB::table('pjkkendaraan')
            ->join('kode_kantors', 'pjkkendaraan.kantor_id', '=', 'kode_kantors.id')
            ->where('pjkkendaraan.status_bayar',$status_bayar)
            ->select('pjkkendaraan.id','pjkkendaraan.nopol','pjkkendaraan.tgl_habis_stnk',
            'pjkkendaraan.tgl_pajak_tahunan','pjkkendaraan.nilai_pajak',
            'pjkkendaraan.pemegang_kendaraan','pjkkendaraan.status_bayar','pjkkendaraan.keterangan',
            'pjkkendaraan.kantor_id','kode_kantors.nama_kantor')
            ->orderBy('id','desc')
            ->get();

        //}
        return $this->sendResponse($pjkkendaraan, 'pjkkendaraan list');
    }//endfilter
}//endclass
