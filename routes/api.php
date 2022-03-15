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
    Route::get('tabungan/download/{tabungan}', 'TabunganController@downloadfile');
    Route::post('tabungan/ceknorek', 'TabunganController@ceknorek');
    Route::get('deposito/download/{deposito}', 'DepositoController@downloadfile');
    Route::post('deposito/ceknorek', 'DepositoController@ceknorek');
    Route::get('kredit/download/{kredit}', 'KreditController@downloadfile');
    Route::post('kredit/ceknorek', 'KreditController@ceknorek');
    Route::get('teller/download/{teller}', 'TellerController@downloadfile');
    Route::get('kaskecil/download/{kaskecil}', 'KaskecilController@downloadfile');
    Route::get('overbooking/download/{overbooking}', 'OverbookingController@downloadfile');
    Route::get('rekkoranaba/download/{rekkoranaba}', 'RekkoranabaController@downloadfile');
    Route::get('skdir/download/{skdir}', 'SkdirController@downloadfile');
    Route::post('skdir/ceknorek', 'SkdirController@ceknorek');
    Route::get('sedir/download/{sedir}', 'SedirController@downloadfile');
    Route::post('sedir/ceknorek', 'SedirController@ceknorek');
    Route::get('akta/download/{akta}', 'AktaController@downloadfile');
    Route::post('akta/ceknorek', 'AktaController@ceknorek');
    Route::get('legal/download/{legal}', 'LegalController@downloadfile');
    Route::post('legal/ceknorek', 'LegalController@ceknorek');
    Route::get('sertifikat/download/{sertifikat}', 'SertifController@downloadfile');
    Route::post('sertifikat/ceknorek', 'SertifController@ceknorek');
    Route::get('pk/download/{pk}', 'PkController@downloadfile');
    Route::post('pk/ceknorek', 'PkController@ceknorek');
    Route::get('pjkbadan/download/{pjkbadan}', 'PjkbadanController@downloadfile');
    Route::get('pjksewa/download/{pjksewa}', 'PjksewaController@downloadfile');
    Route::get('pjkpph21/download/{pjkpph21}', 'Pjkpph21Controller@downloadfile');
    Route::get('pjkbunga/download/{pjkbunga}', 'PjkbungaController@downloadfile');
    Route::get('asuransi/download/{asuransi}', 'AsuransiController@downloadfile');
    Route::get('sop/download/{sop}', 'SopController@downloadfile');
    Route::get('peraturan/download/{peraturan}', 'PeraturanController@downloadfile');
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


    Route::apiResources([
        //setting
        'satuan'      => 'SatuanController',

        'user'        => 'UserController',
        //pelayanan
        'bakas'       => 'BakasController',
        'tabungan'    => 'TabunganController',
        'deposito'    => 'DepositoController',
        'teller'      => 'TellerController',

        //kredit
        'kredit'      => 'KreditController',

        //akunting
        'kaskecil'    => 'KaskecilController',
        'overbooking' => 'OverbookingController',
        'rekkoranaba' => 'RekkoranabaController',
        'stock'       => 'StockController',

        // umum pusat
        'skdir'       => 'SkdirController',
        'sedir'       => 'SedirController',
        'akta'        => 'AktaController',
        'legal'       => 'LegalController',
        'sertifikat'  => 'SertifController',
        'pk'          => 'PkController',
        'pjkbadan'    => 'PjkbadanController',
        'pjksewa'     => 'PjksewaController',
        'pjkpph21'    => 'Pjkpph21Controller',
        'pjkbunga'    => 'PjkbungaController',
        'asuransi'    => 'AsuransiController',
        'sop'         => 'SopController',
        'peraturan'   => 'PeraturanController',
        'lapkap'      => 'LapkapController',
        'lapkeu'      => 'LapkeuController',

        //sekdir
        'suratmasuk'  => 'SuratmasukController',
        'suratkeluar' => 'SuratkeluarController',
        'notulen'     => 'NotulenController',
        'polis'       => 'PolisController',

        // skai
        'monitor'     => 'MonitorController',
        'periksa'       => 'PeriksaController',


    ]);
});
