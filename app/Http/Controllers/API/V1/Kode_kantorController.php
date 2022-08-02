<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Kode_kantor;

class Kode_kantorController extends BaseController
{
    protected $kantor = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Kode_kantor $kantor)
    {
        $this->middleware('auth:api');
        $this->kantor= $kantor;
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kantor  = Kode_kantor::get();

        return $this->sendResponse($kantor, 'Daftar Kantor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kantor = Kode_kantor::create([
            'kode_kantor'       => $request['kode_kantor'],
            'kode_kantor_slik'  => $request['kode_kantor_slik'],
            'nama_kantor'       => $request['nama_kantor'],
        ]);
        return $this->sendResponse($kantor, 'Kantor Ditambahkan');
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
        $kantor = Kode_kantor::findOrFail($id);
       // dd($request->nama_kantor);

       $kantor->update($request->all());

        return $this->sendResponse($kantor, 'Data Kantor Diubah!');
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

        $kantor = Kode_kantor::findOrFail($id);
        // delete data kantor

        $kantor->delete();

        return $this->sendResponse([$kantor], 'Kantor sudah dihapus!');
    }
}
