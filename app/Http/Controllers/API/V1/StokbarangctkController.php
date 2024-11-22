<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Stock;
use App\Models\Stokbarangctk;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StokbarangctkController extends BaseController
{
    protected $stokbarangctk = '';
    //protected $barang = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Stokbarangctk $stokbarangctk)
    {
        $this->middleware('auth:api');
        $this->stokbarangctk = $stokbarangctk;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_kantor = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
        // $stock=stock::all();
        $stock = $this->stokbarangctk->latest()->get();
        if ($levelLogin === 'admin') {
            $stock = DB::table('stokbarangctk AS stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->join('barang', 'stock.barang_id', '=', 'barang.id')
                ->join('satuan', 'stock.satuan_id', '=', 'satuan.id')
                ->select(
                    'stock.id',
                    'stock.periode',
                    'stock.created_at',
                    'stock.barang_id',
                    'stock.satuan_id',
                    'stock.harga_satuan',
                    'stock.stok_awal',
                    'stock.stok_masuk',
                    'stock.stok_keluar',
                    'stock.stok_akhir',
                    'stock.nom_awal',
                    'stock.nom_masuk',
                    'stock.nom_keluar',
                    'stock.nom_akhir',
                    'stock.keterangan',
                    'stock.file',
                    'stock.view',
                    'stock.kantor_id',
                    'kode_kantors.kode_kantor',
                    'kode_kantors.nama_kantor',
                    'barang.namabarang',
                    'satuan.namasatuan'
                )
                ->orderBy('stock.id', 'desc')
                ->get();
        } else {
            $stock = DB::table('stokbarangctk AS stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->join('barang', 'stock.barang_id', '=', 'barang.id')
                ->join('satuan', 'stock.satuan_id', '=', 'satuan.id')
                ->where('kantor_id', $id_kantor)
                ->select(
                    'stock.id',
                    'stock.periode',
                    'stock.created_at',
                    'stock.barang_id',
                    'stock.satuan_id',
                    'stock.harga_satuan',
                    'stock.stok_awal',
                    'stock.stok_masuk',
                    'stock.stok_keluar',
                    'stock.stok_akhir',
                    'stock.nom_awal',
                    'stock.nom_masuk',
                    'stock.nom_keluar',
                    'stock.nom_akhir',
                    'stock.keterangan',
                    'stock.file',
                    'stock.view',
                    'stock.kantor_id',
                    'kode_kantors.kode_kantor',
                    'kode_kantors.nama_kantor',
                    'barang.namabarang',
                    'satuan.namasatuan'
                )
                ->orderBy('stock.id', 'desc')
                ->get();
        }
        // dd($stock);

        return $this->sendResponse($stock, 'stock barang list');
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
            'barang_id' => 'required',
            'satuan_id' => 'required',
            'periode' => 'required',
            'harga_satuan' => 'required',
            'stok_awal' => 'required',
            'stok_masuk' => 'required',
            'stok_keluar' => 'required',
            'stok_akhir' => 'required',
            'nom_awal' => 'required',
            'nom_masuk' => 'required',
            'nom_keluar' => 'required',
            'nom_akhir' => 'required'
        ], [
            'barang_id.required' => 'barang belum dipilih',
            'satuan_id.required' => 'satuan belum dipilih',
            'periode.required' => 'periode belum dipilih',
            'harga_Satuan.required' => 'harga satuan belum diisi',
            'stok_awal.required' => 'stok awal belum diisi',
            'stok_masuk.required' => 'stok masuk belum diisi',
            'stok_keluar.required' => 'stok keluar belum diisi',
            'stok_akhir.required' => 'stok akhir belum diisi',
            'nom_awal.required' => 'nominal awal belum diisi',
            'nom_masuk.required' => 'nominal masuk belum diisi',
            'nom_keluar.required' => 'nominal keluar belum diisi',
            'nom_akhir.required' => 'nominal akhir belum diisi'
        ]);

        //$nm         = $request->file('file');
        //$acak = $this->acak_string(5);
        //$file   = "img_barangcetak" . $request->kantor_id . "." . $acak . "." . $nm->getClientOriginalName();
        $file = null;  // Inisialisasi default variabel $file

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $nm = $request->file('file');  // Definisikan $nm hanya jika file ada dan valid
            $acak = $this->acak_string(5);
            $file = "img_barangcetak" . $request->kantor_id . "." . $acak . "." . $nm->getClientOriginalName();
            $nm->move(public_path() . '/file/barangcetak', $file);
        }
        
        $stokbarangctk = $this->stokbarangctk->create([
            'kantor_id' => $request->get('kantor_id'),
            'periode' => $request->get('periode'),
            'barang_id' => $request->get('barang_id'),
            'satuan_id' => $request->get('satuan_id'),
            'harga_satuan' => $request->get('harga_satuan'),
            'stok_awal' => $request->get('stok_awal'),
            'stok_masuk' => $request->get('stok_masuk'),
            'stok_keluar' => $request->get('stok_keluar'),
            'stok_akhir' => $request->get('stok_akhir'),
            'nom_awal' => $request->get('nom_awal'),
            'nom_masuk' => $request->get('nom_masuk'),
            'nom_keluar' => $request->get('nom_keluar'),
            'nom_akhir' => $request->get('nom_akhir'),
            'keterangan' => $request->get('keterangan'),
            'file' => $file,
            'view' => $file,
        ]);
        

        //dd($stokbarangctk);
        return $this->sendResponse($stokbarangctk, 'Data stok barang cetakan di input');
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
        $stokbarangctk = Stokbarangctk::findOrFail($id);
        //dd($request->get('jml_stok_awal'));

        // $stock->update($request->all());

        //return $this->sendResponse($stock, 'Data User Diubah!');
    }
    public function update(Request $request, $id)
    {
        $stokbarangctk = Stokbarangctk::findOrFail($id);

        // Menyiapkan data untuk pembaruan

        $dataToUpdate = [

            'periode' => $request->get('periode'),

            'harga_satuan' => $request->get('harga_satuan'),

            'stok_awal' => $request->get('stok_awal'),

            'stok_masuk' => $request->get('stok_masuk'),

            'stok_keluar' => $request->get('stok_keluar'),

            'stok_akhir' => $request->get('stok_akhir'),

            'nom_awal' => $request->get('nom_awal'),

            'nom_masuk' => $request->get('nom_masuk'),

            'nom_keluar' => $request->get('nom_keluar'),

            'nom_akhir' => $request->get('nom_akhir'),

            'keterangan' => $request->get('keterangan'),

            'file' => null, // Sementara di-set null, akan diisi jika ada file

            'view' => null, // Sementara di-set null, akan diisi jika ada file

        ];

        // Cek dan update barang_id jika tidak null

        if ($request->get('barang_id') !== null) {

            $dataToUpdate['barang_id'] = $request->get('barang_id');
        }

        // Cek dan update satuan_id jika tidak null

        if ($request->get('satuan_id') !== null) {

            $dataToUpdate['satuan_id'] = $request->get('satuan_id');
        }

        // Proses upload file jika ada

        if ($request->hasFile('file')) {

            $nm = $request->file('file');

            $acak = $this->acak_string(5);

            $file = "img_barangcetak" . $request->kantor_id . "." . $acak . "." . $nm->getClientOriginalName();

            $dataToUpdate['file'] = $file;

            $dataToUpdate['view'] = $file;

            $nm->move(public_path() . '/file/barangcetak', $file);
        }


        // Update data

        $stokbarangctk->update($dataToUpdate);
        return $this->sendResponse($stokbarangctk, 'Data Stokctk Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('isAdmin');

        $stokbarangctk = $this->stokbarangctk->findOrFail($id);
        // Path file yang akan dihapus

        $file = public_path("file/barangcetak/" . $stokbarangctk->file);

        // Cek apakah file ada

        if (!file_exists($file)) {

            // Jika file tidak ada, hapus hanya dari database

            $stokbarangctk->delete();

            return $this->sendResponse($stokbarangctk, 'Stok sudah dihapus, tetapi file tidak ditemukan di storage.');
        } else {
            // Jika file ada, pastikan itu adalah file dan bukan direktori

            if (is_file($file)) {

                unlink($file); // Hapus file dari storage

            }

            $stokbarangctk->delete();

            return $this->sendResponse($stokbarangctk, 'Stok sudah dihapus dan file juga dihapus dari storage.');
        }
    }

    public function listbarang()
    {
        $barang = Barang::get();

        return $this->sendResponse($barang, 'List Barang');
    }

    public function filtertanggal(Request $request)
    {
        //dd($request->all());
        $periodetgl = $request->periodetgl;

        $id_kantor = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
        // $stock=stock::all();
        $stock = $this->stokbarangctk->latest()->get();
        if ($levelLogin === 'admin') {
            $stock = DB::table('stokbarangctk AS stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->join('barang', 'stock.barang_id', '=', 'barang.id')
                ->join('satuan', 'stock.satuan_id', '=', 'satuan.id')
                ->where('periode', $periodetgl)
                ->select(
                    'stock.id',
                    'stock.periode',
                    'stock.created_at',
                    'stock.barang_id',
                    'stock.satuan_id',
                    'stock.harga_satuan',
                    'stock.stok_awal',
                    'stock.stok_masuk',
                    'stock.stok_keluar',
                    'stock.stok_akhir',
                    'stock.nom_awal',
                    'stock.nom_masuk',
                    'stock.nom_keluar',
                    'stock.nom_akhir',
                    'stock.keterangan',
                    'stock.file',
                    'stock.view',
                    'stock.kantor_id',
                    'kode_kantors.kode_kantor',
                    'kode_kantors.nama_kantor',
                    'barang.namabarang',
                    'satuan.namasatuan'
                )
                ->orderBy('periode')
                ->get();
        } else {
            $stock = DB::table('stokbarangctk AS stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->join('barang', 'stock.barang_id', '=', 'barang.id')
                ->join('satuan', 'stock.satuan_id', '=', 'satuan.id')
                ->where('kantor_id', $id_kantor)
                ->where('periode', $periodetgl)
                ->select(
                    'stock.id',
                    'stock.periode',
                    'stock.created_at',
                    'stock.barang_id',
                    'stock.satuan_id',
                    'stock.harga_satuan',
                    'stock.stok_awal',
                    'stock.stok_masuk',
                    'stock.stok_keluar',
                    'stock.stok_akhir',
                    'stock.nom_awal',
                    'stock.nom_masuk',
                    'stock.nom_keluar',
                    'stock.nom_akhir',
                    'stock.keterangan',
                    'stock.file',
                    'stock.view',
                    'stock.kantor_id',
                    'kode_kantors.kode_kantor',
                    'kode_kantors.nama_kantor',
                    'barang.namabarang',
                    'satuan.namasatuan'
                )
                ->orderBy('periode')
                ->get();
        }
        //dd($stock);

        return $this->sendResponse($stock, 'stock list');
    }

    public function filterkantor(Request $request)
    {
        //dd($request->all());
        $kantor_id = $request->kantor_id;


        $id_kantor = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
        // $stock=stock::all();
        $stock = $this->stokbarangctk->latest()->get();
        if ($levelLogin === 'admin') {

            $stock = DB::table('stokbarangctk AS stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->join('barang', 'stock.barang_id', '=', 'barang.id')
                ->join('satuan', 'stock.satuan_id', '=', 'satuan.id')
                ->where('kantor_id', $kantor_id)
                ->select(
                    'stock.id',
                    'stock.periode',
                    'stock.created_at',
                    'stock.barang_id',
                    'stock.satuan_id',
                    'stock.harga_satuan',
                    'stock.stok_awal',
                    'stock.stok_masuk',
                    'stock.stok_keluar',
                    'stock.stok_akhir',
                    'stock.nom_awal',
                    'stock.nom_masuk',
                    'stock.nom_keluar',
                    'stock.nom_akhir',
                    'stock.keterangan',
                    'stock.file',
                    'stock.view',
                    'stock.kantor_id',
                    'kode_kantors.kode_kantor',
                    'kode_kantors.nama_kantor',
                    'barang.namabarang',
                    'satuan.namasatuan'
                )
                ->orderBy('kantor_id')
                ->get();
        }
        //dd($stock);

        return $this->sendResponse($stock, 'stock list');
    }

    public function filterbarang(Request $request)
    {
        //dd($request->all());
        $barang_id = $request->barang_id;


        $id_kantor = Auth::user()->kantor_id;
        $levelLogin = Auth::user()->type;
        // $stock=stock::all();
        $stock = $this->stokbarangctk->latest()->get();
        if ($levelLogin === 'admin') {

            $stock = DB::table('stokbarangctk AS stock')
                ->join('kode_kantors', 'stock.kantor_id', '=', 'kode_kantors.id')
                ->join('barang', 'stock.barang_id', '=', 'barang.id')
                ->join('satuan', 'stock.satuan_id', '=', 'satuan.id')
                ->where('barang_id', $barang_id)
                ->select(
                    'stock.id',
                    'stock.periode',
                    'stock.created_at',
                    'stock.barang_id',
                    'stock.satuan_id',
                    'stock.harga_satuan',
                    'stock.stok_awal',
                    'stock.stok_masuk',
                    'stock.stok_keluar',
                    'stock.stok_akhir',
                    'stock.nom_awal',
                    'stock.nom_masuk',
                    'stock.nom_keluar',
                    'stock.nom_akhir',
                    'stock.keterangan',
                    'stock.file',
                    'stock.view',
                    'stock.kantor_id',
                    'kode_kantors.kode_kantor',
                    'kode_kantors.nama_kantor',
                    'barang.namabarang',
                    'satuan.namasatuan'
                )
                ->orderBy('barang_id')
                ->get();
        }
        //dd($stock);

        return $this->sendResponse($stock, 'stock list');
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
