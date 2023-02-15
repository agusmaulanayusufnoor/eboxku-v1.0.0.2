<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Mastersimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MastersimpananController extends BaseController
{
    protected $mastersimpanan = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mastersimpanan $mastersimpanan)
    {
        $this->middleware('auth:api');
        $this->mastersimpanan= $mastersimpanan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mastersimpanan  = Mastersimpanan::get();

        return $this->sendResponse($mastersimpanan, 'List Mastersimpanan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mastersimpanan = Mastersimpanan::create([
            'jenissimpanan'  => $request['namamastersimpanan'],
        ]);
        return $this->sendResponse($mastersimpanan, 'Mastersimpanan Ditambahkan');
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
       $mastersimpanan = Mastersimpanan::findOrFail($id);
       // dd($request->namamastersimpanan);

       $mastersimpanan->update($request->all());

        return $this->sendResponse($mastersimpanan, 'Data Mastersimpanan Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $mastersimpanan = Mastersimpanan::findOrFail($id);
       // dd($request->namamastersimpanan);

       $mastersimpanan->update($request->namamastersimpanan);

        return $this->sendResponse($mastersimpanan, 'Data Mastersimpanan Diubah!');
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

        $mastersimpanan = Mastersimpanan::findOrFail($id);
        // delete data mastersimpanan

        $mastersimpanan->delete();

        return $this->sendResponse([$mastersimpanan], 'Mastersimpanan sudah dihapus!');
    }
}
