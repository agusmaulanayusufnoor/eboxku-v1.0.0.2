<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Statuspegawai;
use Illuminate\Http\Request;

class StatuspegawaiController extends BaseController
{
    protected $statuspegawai = '';
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Statuspegawai $statuspegawai)
    {
        $this->middleware('auth:api');
        $this->statuspegawai= $statuspegawai;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuspegawai  = Statuspegawai::get();

        return $this->sendResponse($statuspegawai, 'List Status Pegawai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $statuspegawai = Statuspegawai::create([
            'statuspegawai'  => $request['statuspegawai'],
        ]);
        return $this->sendResponse($statuspegawai, 'Status Pegawai Ditambahkan');
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
       $statuspegawai = Statuspegawai::findOrFail($id);
       // dd($request->namastatuspegawai);

       $statuspegawai->update($request->all());

        return $this->sendResponse($statuspegawai, 'Data Status Pegawai Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $statuspegawai = Statuspegawai::findOrFail($id);
       // dd($request->namastatuspegawai);

       $statuspegawai->update($request->statuspegawai);

        return $this->sendResponse($statuspegawai, 'Data Status Pegawai Diubah!');
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

        $statuspegawai = Statuspegawai::findOrFail($id);
        // delete data statuspegawai

        $statuspegawai->delete();

        return $this->sendResponse([$statuspegawai], 'Status Pegawai Sudah Dihapus!');
    }
}
