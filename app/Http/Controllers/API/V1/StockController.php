<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use App\Models\Stock;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockController extends BaseController
{
    protected $stock = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Stock $stock)
    {
        $this->middleware('auth:api');
        $this->stock= $stock;
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

        if ($levelLogin === 'admin' || $levelLogin === 'akunting') {
            $stock  = DB::table('stock')
            ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
            ->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
            'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
            'stock.jenis','stock.kantor_id','kode_kantors.kode_kantor_slik as kode_kantor')
            ->orderBy('stock.tanggal')
            ->get();
        } else {
            $stock  = DB::table('stock')
            ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
            ->where('stock.kantor_id', $id_kantor)
            ->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
            'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
            'stock.jenis','stock.kantor_id','kode_kantors.kode_kantor_slik as kode_kantor')
            ->orderBy('stock.id','desc')
            ->get();
        }

        return $this->sendResponse($stock, 'stock list');
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
            'jenis'             => 'required',
            'tanggal'           => 'required',
            'jml_stok_awal'     => 'required',
            'tambahan_stok'     => 'required',
            'jml_digunakan'     => 'required',
            'jml_rusak'         => 'required',
            'jml_hilang'        => 'required',
            'jml_stok_akhir'    => 'required'
        ],[
            'jenis.required'            => 'jenis belum dipilih',
            'tanggal.required'          => 'tanggal belum dipilih',
            'jml_stok_awal.required'    => 'jumlah stok awal belum diisi',
            'tambahan_stok.required'    => 'tambahan stok belum diisi',
            'jml_digunakan.required'    => 'jumlah digunakan belum diisi',
            'jml_rusak.required'        => 'jumlah rusak belum diisi',
            'jml_hilang.required'       => 'jumlah hilang awal belum diisi',
            'jml_stok_akhir.required'   => 'jumlah stok akhir awal belum diisi'
        ]);


        $hari       = substr($request->tanggal,8,2);
        $bulan      = substr($request->tanggal,5,2);
        $tahun      = substr($request->tanggal,0,4);
        $arr        = array($hari,"/",$bulan,"/",$tahun);
        $arrnamefile        = array($hari,$bulan,$tahun);
        $datefile   = implode("",$arrnamefile);

        $date       = implode("",$arr);
        //dd($request->tanggal);
        $stock = $this->stock->create([
            'jenis'             => $request->get('jenis'),
            'kantor_id'         => $request->get('kantor_id'),
            'tanggal'           => $request->get('tanggal'),
            'jml_stok_awal'     => $request->get('jml_stok_awal'),
            'tambahan_stok'     => $request->get('tambahan_stok'),
            'jml_digunakan'     => $request->get('jml_digunakan'),
            'jml_rusak'         => $request->get('jml_rusak'),
            'jml_hilang'        => $request->get('jml_hilang'),
            'jml_stok_akhir'    => $request->get('jml_stok_akhir'),
        ]);


        return $this->sendResponse($stock, 'File telah diupload...');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        $stock->update($request->all());

        return $this->sendResponse($stock, 'Data Stok Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = $this->stock->findOrFail($id);

        $stock->delete();

        return $this->sendResponse($stock, 'Stock sudah dihapus!');
    }

    public function filterkantor(Request $request)
    {
        $kantor_id  = $request->kantor_id;
        $id_kantor  = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;

        if ($levelLogin === 'admin' || $levelLogin === 'akunting') {
            $query = DB::table('stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id');
            if ($kantor_id != '') {
                $query->where('stock.kantor_id', $kantor_id);
            }
            $stock = $query->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
                'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
                'stock.jenis','stock.kantor_id','kode_kantors.kode_kantor_slik as kode_kantor')
                ->orderBy('stock.tanggal')
                ->get();
        } else {
            $stock  = DB::table('stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->where('stock.kantor_id', $id_kantor)
                ->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
                'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
                'stock.jenis','stock.kantor_id','kode_kantors.kode_kantor_slik as kode_kantor')
                ->orderBy('stock.id','desc')
                ->get();
        }

        return $this->sendResponse($stock, 'stock list');
    }

    public function filtertanggal(Request $request)
    {
         $fromtgl   = $request->fromtgl;
         $totgl     = $request->totgl;
         $id_kantor = Auth::user()->kantor_id;
         $levelLogin = Auth::user()->type;

         if ($levelLogin === 'admin' || $levelLogin === 'akunting') {
             $query = DB::table('stock')
                 ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                 ->whereBetween('tanggal', [$fromtgl, $totgl]);

             if ($request->has('kantor_id') && $request->kantor_id != '') {
                 $query->where('stock.kantor_id', $request->kantor_id);
             }

             $stock = $query->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
             'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
             'stock.jenis','stock.kantor_id','kode_kantors.kode_kantor_slik as kode_kantor')
             ->orderBy('tanggal')
             ->get();
         } else {
             $stock  = DB::table('stock')
             ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
             ->where('stock.kantor_id', $id_kantor)
             ->whereBetween('tanggal', [$fromtgl, $totgl])
             ->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
             'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
             'stock.jenis','stock.kantor_id','kode_kantors.kode_kantor_slik as kode_kantor')
             ->orderBy('tanggal')
             ->get();
         }

         return $this->sendResponse($stock, 'stock list');
    }
}
