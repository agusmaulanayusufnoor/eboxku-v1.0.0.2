<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {

       
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
    Route::post('product/upload', 'ProductController@upload');
    Route::get('bakas/download/{baka}', 'BakasController@downloadfile');
    Route::post('bakas/cektgl', 'BakasController@cektgl');
    Route::get('cs/download/{cs}', 'CsController@downloadfile');
    Route::post('cs/cektgl', 'CsController@cektgl');
    Route::get('permoperasional/download/{permoperasional}', 'PermoperasionalController@downloadfile');
    Route::post('permoperasional/{permoperasional}', 'PermoperasionalController@updateData');
    Route::get('permbisnis/filememo/{permbisnis}', 'PermbisnisController@downloadfilememo');
    Route::get('permbisnis/download/{permbisnis}', 'PermbisnisController@downloadfile');
    Route::post('permbisnis/{permbisnis}', 'PermbisnisController@updateData');
    Route::get('feedback/download/{feedback}', 'FeedbackController@downloadfile');
    Route::get('tabungan/download/{tabungan}', 'TabunganController@downloadfile');
    Route::post('tabungan/ceknorek', 'TabunganController@ceknorek');
    Route::get('deposito/download/{deposito}', 'DepositoController@downloadfile');
    Route::post('deposito/ceknorek', 'DepositoController@ceknorek');
    Route::get('kredit/download/{kredit}', 'KreditController@downloadfile');
    Route::post('kredit/ceknorek', 'KreditController@ceknorek');
    Route::get('permohonankredit/download/{permohonankredit}', 'PermohonankreditController@downloadfile');
    Route::get('permohonankredit/filesetuju/{permohonankredit}', 'PermohonankreditController@downloadfiledisetujui');
    Route::get('permohonankredit/filespk/{permohonankredit}', 'PermohonankreditController@downloadfilespk');
    Route::post('permohonankredit/ceknorek', 'PermohonankreditController@ceknorek');
    Route::post('permohonankredit/{permohonankredit}', 'PermohonankreditController@updateData');
    Route::get('permohonankredit/filtertanggal', 'PermohonankreditController@filtertanggal');
    Route::get('pelunasan/download/{pelunasan}', 'PelunasanController@downloadfile');
    Route::post('pelunasan/ceknorek', 'PelunasanController@ceknorek');
    Route::get('pelunasan/getkantor', 'Kode_kantorController@index');
    Route::get('asuransikredit/download/{asuransikredit}', 'AsuransikreditController@downloadfile');
    Route::get('asuransikredit/getkantor', 'Kode_kantorController@index');
    Route::get('asuransikredit/filterkantor', 'AsuransikreditController@filterkantor');
    Route::get('teller/download/{teller}', 'TellerController@downloadfile');
    Route::get('teller/getotorisator', 'OtorisatorController@index');
    Route::get('teller/getkantor', 'Kode_kantorController@index');
    Route::get('teller/filterkantor', 'TellerController@filterkantor');
    Route::get('teller/filterotorisator', 'TellerController@filterotorisator');
    Route::get('kaskecil/download/{kaskecil}', 'KaskecilController@downloadfile');
    Route::get('kaskecil/getotorisator', 'OtorisatorController@index');
    Route::get('kaskecil/getkantor', 'Kode_kantorController@index');
    Route::get('kaskecil/filterkantor', 'KaskecilController@filterkantor');
    Route::get('kaskecil/filterotorisator', 'KaskecilController@filterotorisator');
    Route::get('overbooking/download/{overbooking}', 'OverbookingController@downloadfile');
    Route::get('overbooking/getotorisator', 'OtorisatorController@index');
    Route::get('overbooking/getkantor', 'Kode_kantorController@index');
    Route::get('overbooking/filterkantor', 'OverbookingController@filterkantor');
    Route::get('overbooking/filterotorisator', 'OverbookingController@filterotorisator');
    Route::get('rekkoranaba/download/{rekkoranaba}', 'RekkoranabaController@downloadfile');
    Route::get('rekkoranaba/getkantor', 'Kode_kantorController@index');
    Route::get('rekkoranaba/filterkantor', 'RekkoranabaController@filterkantor');
    Route::get('rekkoranaba/filterjenis', 'RekkoranabaController@filterjenis');
    Route::get('memoumum/download/{memoumum}', 'MemoumumController@downloadfile');
    Route::get('memoumum/filterjenis', 'MemoumumController@filterjenis');
    Route::get('memoob/download/{memoob}', 'MemoobController@downloadfile');
    Route::get('memoob/filterkantor', 'MemoobController@filterkantor');
    Route::get('memoob/getkantor', 'Kode_kantorController@index');
    Route::get('skdir/download/{skdir}', 'SkdirController@downloadfile');
    Route::post('skdir/ceknorek', 'SkdirController@ceknorek');
    Route::get('sedir/download/{sedir}', 'SedirController@downloadfile');
    Route::post('sedir/ceknorek', 'SedirController@ceknorek');
    Route::get('akta/download/{akta}', 'AktaController@downloadfile');
    Route::post('akta/ceknorek', 'AktaController@ceknorek');
    Route::get('legal/download/{legal}', 'LegalController@downloadfile');
    Route::get('sertifikat/download/{sertifikat}', 'SertifController@downloadfile');
    Route::post('sertifikat/ceknorek', 'SertifController@ceknorek');
    Route::get('pk/download/{pk}', 'PkController@downloadfile');
    Route::post('pk/ceknorek', 'PkController@ceknorek');
    Route::post('pk/ceknorek', 'PkController@updateData');
    Route::get('pk/filtertglmulai', 'PkController@filtertglmulai');
    Route::get('pk/filtertglakhir', 'PkController@filtertglakhir');
    Route::get('pjkbadan/download/{pjkbadan}', 'PjkbadanController@downloadfile');
    Route::get('pjksewa/download/{pjksewa}', 'PjksewaController@downloadfile');
    Route::get('pjkpph21/download/{pjkpph21}', 'Pjkpph21Controller@downloadfile');
    Route::get('pjkpph21/getkantor', 'Kode_kantorController@index');
    Route::get('pjkpph23/download/{pjkpph23}', 'Pjkpph23Controller@downloadfile');
    Route::get('pjkpph25/download/{pjkpph25}', 'Pjkpph25Controller@downloadfile');
    Route::get('pjkpph4ayat2/download/{pjkpph4ayat2}', 'Pjkpph4ayat2Controller@downloadfile');
    Route::get('pjkbunga/download/{pjkbunga}', 'PjkbungaController@downloadfile');
    Route::post('pjkkendaraan/ceknorek', 'PjkkendaraanController@ceknorek');
    Route::get('pjkkendaraan/getkantor', 'Kode_kantorController@index');
    Route::get('pjkkendaraan/filterkantor', 'PjkkendaraanController@filterkantor');
    Route::get('pjkkendaraan/filterstatus', 'PjkkendaraanController@filterstatus');
    Route::get('asuransi/download/{asuransi}', 'AsuransiController@downloadfile');
    Route::get('sop/download/{sop}', 'SopController@downloadfile');
    Route::get('peraturan/download/{peraturan}', 'PeraturanController@downloadfile');
    Route::get('lps/download/{lps}', 'LpsController@downloadfile');
    Route::get('jtakuntingpusat/download/{jtakuntingpusat}', 'JtakuntingpusatController@downloadfile');
    Route::get('jtpelayananpusat/download/{jtakuntingpusat}', 'JtpelayananpusatController@downloadfile');
    Route::get('lapkap/download/{lapkap}', 'LapkapController@downloadfile');
    Route::get('lapkeu/download/{lapkeu}', 'LapkeuController@downloadfile');
    Route::get('suratmasuk/download/{suratmasuk}', 'SuratmasukController@downloadfile');
    Route::post('suratmasuk/ceknorek', 'SuratmasukController@ceknorek');
    Route::get('suratkeluar/download/{suratkeluar}', 'SuratkeluarController@downloadfile');
    Route::post('suratkeluar/ceknorek', 'SuratkeluarController@ceknorek');
    Route::get('notulen/download/{notulen}', 'NotulenController@downloadfile');
    Route::get('polis/download/{polis}', 'PolisController@downloadfile');
    Route::get('monitor/download/{monitor}', 'MonitorController@downloadfile');
    Route::get('periksa/download/{periksa}', 'PeriksaController@downloadfile');
    Route::post('stock/{stock}', 'StockController@updateData');
    Route::get('stock/filtertanggal', 'StockController@filtertanggal');
    Route::post('satuan/{stock}', 'SatuanController@updateData');
    Route::post('barang/{stock}', 'BarangController@updateData');
    Route::post('otorisator/{stock}', 'OtorisatorController@updateData');
    Route::post('kantor/{stock}', 'Kode_kantorController@updateData');
    Route::post('stockctk/{stock}', 'StokbarangctkController@updateData');
    //Route::post('stockctk/import', 'StokbarangctkController@import')->name('stockctk.import');
    Route::get('stockctk/getkantor', 'Kode_kantorController@index');
    Route::get('stockctk/getbarang', 'BarangController@index');
    Route::get('stockctk/getsatuan', 'SatuanController@index');
    Route::get('stockctk/filtertanggal', 'StokbarangctkController@filtertanggal');
    Route::get('stockctk/filterkantor', 'StokbarangctkController@filterkantor');
    Route::get('stockctk/filterbarang', 'StokbarangctkController@filterbarang');
    Route::get('stockpromosi/getkantor', 'Kode_kantorController@index');
    Route::get('stockpromosi/getbarang', 'BarangController@index');
    Route::get('stockpromosi/getsatuan', 'SatuanController@index');
    Route::get('stockpromosi/filtertanggal', 'StokbarangpromosiController@filtertanggal');
    Route::get('stockpromosi/filterkantor', 'StokbarangpromosiController@filterkantor');
    Route::get('stockpromosi/filterbarang', 'StokbarangpromosiController@filterbarang');


    Route::apiResources([
        //setting
        'satuan'        => 'SatuanController',
        'barang'        => 'BarangController',
        'otorisator'    => 'OtorisatorController',
        'kantor'        => 'Kode_kantorController',
        'jabatan'       => 'JabatanController',
        'pendidikan'    => 'PendidikanController',
        'statuspegawai' => 'StatuspegawaiController',
        'statuspajak'   => 'StatuspajakController',
        'mastersimpanan'   => 'MastersimpananController',
        'statuspermohonan'        => 'StatuspermohonanController',

        'user'        => 'UserController',
        //pelayanan
        'bakas'       => 'BakasController',
        'feedback'    => 'FeedbackController',
        'tabungan'    => 'TabunganController',
        'deposito'    => 'DepositoController',
        'teller'      => 'TellerController',
        'cs'          => 'CsController',
        'permoperasional'  => 'PermoperasionalController',
        'permbisnis'  => 'PermbisnisController',

        //kredit
        'permohonankredit'  => 'PermohonankreditController',
        'kredit'            => 'KreditController',
        'pelunasan'         => 'PelunasanController',
        'asuransikredit'    => 'AsuransikreditController',

        //akunting
        'kaskecil'      => 'KaskecilController',
        'overbooking'   => 'OverbookingController',
        'rekkoranaba'   => 'RekkoranabaController',
        'stock'         => 'StockController',
        'stockctk'      => 'StokbarangctkController',
        'importstok'   => 'StokctkimportController',
        'stockpromosi'  => 'StokbarangpromosiController',

        // umum pusat
        'memoumum'    => 'MemoumumController',
        'skdir'       => 'SkdirController',
        'sedir'       => 'SedirController',
        'akta'        => 'AktaController',
        'legal'       => 'LegalController',
        'sertifikat'  => 'SertifController',
        'pk'          => 'PkController',
        'pjkbadan'    => 'PjkbadanController',
        'pjksewa'     => 'PjksewaController',
        'pjkpph21'    => 'Pjkpph21Controller',
        'pjkpph4ayat2'=> 'Pjkpph4ayat2Controller',
        'pjkpph23'    => 'Pjkpph23Controller',
        'pjkpph25'    => 'Pjkpph25Controller',
        'pjkbunga'    => 'PjkbungaController',
        'pjkkendaraan'=> 'PjkkendaraanController',
        'asuransi'    => 'AsuransiController',
        'sop'         => 'SopController',
        'peraturan'   => 'PeraturanController',
        'lps'         => 'LpsController',

        //akuntingpusat
        'jtakuntingpusat'   => 'JtakuntingpusatController',
        'jtpelayananpusat'  => 'JtpelayananpusatController',
        'memoob'            => 'MemoobController',
        'lapkap'            => 'LapkapController',
        'lapkeu'            => 'LapkeuController',


        //sekdir
        'suratmasuk'  => 'SuratmasukController',
        'suratkeluar' => 'SuratkeluarController',
        'notulen'     => 'NotulenController',
        'polis'       => 'PolisController',

        // skai
        'monitor'     => 'MonitorController',
        'periksa'     => 'PeriksaController',


    ]);
});
