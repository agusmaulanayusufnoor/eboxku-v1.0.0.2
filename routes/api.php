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
    //Route::post('pelayanan/upload', 'ProductController@upload');

    Route::apiResources([
        'user'      => 'UserController',
        'bakas'     => 'BakasController',
        'tabungan'  => 'TabunganController',
        'deposito'  => 'DepositoController',
        'kredit'    => 'KreditController',
        'teller'    => 'TellerController',

        'product'   => 'ProductController',
        'category'  => 'CategoryController',
        'tag'       => 'TagController',
    ]);
});
