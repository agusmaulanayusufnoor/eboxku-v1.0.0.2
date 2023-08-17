<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Statuspermohonan;
use Illuminate\Http\Request;

class StatuspermohonanController extends BaseController
{
    protected $statuspermohonan = '';
    /**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct(Statuspermohonan $statuspermohonan)
{
    $this->middleware('auth:api');
    $this->statuspermohonan= $statuspermohonan;
}
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    $statuspermohonan  = Statuspermohonan::get();

    return $this->sendResponse($statuspermohonan, 'List Status Permohonan');
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $statuspermohonan = Statuspermohonan::create([
        'statuspermohonan'  => $request['statuspermohonan'],
    ]);
    return $this->sendResponse($statuspermohonan, 'Status Permohonan Ditambahkan');
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
   $statuspermohonan = Statuspermohonan::findOrFail($id);
   // dd($request->namastatuspermohonan);

   $statuspermohonan->update($request->all());

    return $this->sendResponse($statuspermohonan, 'Data Status Permohonan Diubah!');
}
public function updateData(Request $request, $id)
{
    $statuspermohonan = Statuspermohonan::findOrFail($id);
   // dd($request->namastatuspermohonan);

   $statuspermohonan->update($request->statuspermohonan);

    return $this->sendResponse($statuspermohonan, 'Data Status Permohonan Diubah!');
}
/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $this->authorize('isAdmin');

    $statuspermohonan = Statuspermohonan::findOrFail($id);
    // delete data statuspermohonan

    $statuspermohonan->delete();

    return $this->sendResponse([$statuspermohonan], 'Status Permohonan Sudah Dihapus!');
}
}
