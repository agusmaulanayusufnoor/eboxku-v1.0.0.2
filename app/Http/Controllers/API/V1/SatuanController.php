<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SatuanController extends BaseController
{
    protected $satuan = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Satuan $satuan)
    {
        $this->middleware('auth:api');
        $this->satuan= $satuan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan  = Satuan::get();

        return $this->sendResponse($satuan, 'File satuan list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $satuan = Satuan::create([
            'namasatuan'  => $request['namasatuan'],
        ]);
        return $this->sendResponse($satuan, 'Satuan Ditambahkan');
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
       $satuan = Satuan::findOrFail($id);
       // dd($request->namasatuan);

       $satuan->update($request->all());

        return $this->sendResponse($satuan, 'Data Satuan Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $satuan = Satuan::findOrFail($id);
       // dd($request->namasatuan);

       $satuan->update($request->namasatuan);

        return $this->sendResponse($satuan, 'Data Satuan Diubah!');
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

        $satuan = Satuan::findOrFail($id);
        // delete the satuan

        $satuan->delete();

        return $this->sendResponse([$satuan], 'Satuan sudah dihapus!');
    }
}
