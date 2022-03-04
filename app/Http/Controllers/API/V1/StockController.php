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
       // $stock=stock::all();
       $stock= $this->stock->latest()->get();
        if($levelLogin === 'admin'){
            $stock  = DB::table('stock')
            ->join('kode_kantors', 'stock.sandi_kantor', '=', 'kode_kantors.id')
            ->join('stock_jenis', 'stock.jenis', '=', 'stock_jenis.id')
            ->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
            'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
            'stock.jenis','stock_jenis.jenis',
            'stock.sandi_kantor','kode_kantors.nama_kantor')
            ->orderBy('stock.id','desc')
            ->get();
        }else{
            $stock  = DB::table('stock')
            ->join('kode_kantors', 'stock.sandi_kantor', '=', 'kode_kantors.id')
            ->join('stock_jenis', 'stock.jenis', '=', 'stock_jenis.id')
            ->select('stock.id','stock.tanggal','stock.jml_stok_awal','stock.tambahan_stok','stock.jml_digunakan',
            'stock.jml_rusak','stock.jml_hilang','stock.jml_stok_akhir',
            'stock.jenis','stock_jenis.jenis',
            'stock.sandi_kantor','kode_kantors.nama_kantor')
            ->orderBy('stock.id','desc')
            ->get();
        }
        //dd($stock);
        return datatables()->of($stock)
                        ->addColumn('action', function($data){
                            $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-xs edit-post"><i class="far fa-edit"></i></a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></button>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
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
        //
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
        //
    }
}
