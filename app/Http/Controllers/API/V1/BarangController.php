<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangController extends BaseController
{
    protected $barang = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Barang $barang)
    {
        $this->middleware('auth:api');
        $this->barang= $barang;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang  = Barang::get();

        return $this->sendResponse($barang, 'List Barang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = Barang::create([
            'namabarang'  => $request['namabarang'],
        ]);
        return $this->sendResponse($barang, 'Barang Ditambahkan');
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
       $barang = Barang::findOrFail($id);
       // dd($request->namabarang);

       $barang->update($request->all());

        return $this->sendResponse($barang, 'Data Barang Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
       // dd($request->namabarang);

       $barang->update($request->namabarang);

        return $this->sendResponse($barang, 'Data Barang Diubah!');
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

        $barang = Barang::findOrFail($id);
        // delete data barang

        $barang->delete();

        return $this->sendResponse([$barang], 'Barang sudah dihapus!');
    }
}
