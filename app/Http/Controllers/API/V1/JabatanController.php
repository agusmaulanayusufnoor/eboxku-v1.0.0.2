<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends BaseController
{
    protected $jabatan = '';
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Jabatan $jabatan)
    {
        $this->middleware('auth:api');
        $this->jabatan= $jabatan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan  = Jabatan::get();

        return $this->sendResponse($jabatan, 'List Daftar jabatan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jabatan = Jabatan::create([
            'jabatan_pegawai'  => $request['jabatan_pegawai'],
        ]);
        return $this->sendResponse($jabatan, 'jabatan Ditambahkan');
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
       $jabatan = Jabatan::findOrFail($id);
       // dd($request->namajabatan);

       $jabatan->update($request->all());

        return $this->sendResponse($jabatan, 'Data jabatan Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);
       // dd($request->namajabatan);

       $jabatan->update($request->jabatan_pegawai);

        return $this->sendResponse($jabatan, 'Data jabatan Diubah!');
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

        $jabatan = Jabatan::findOrFail($id);
        // delete data jabatan

        $jabatan->delete();

        return $this->sendResponse([$jabatan], 'jabatan sudah dihapus!');
    }
}
