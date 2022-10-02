<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends BaseController
{
    protected $pendidikan = '';
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pendidikan $pendidikan)
    {
        $this->middleware('auth:api');
        $this->Pendidikan= $pendidikan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendidikan  = Pendidikan::get();

        return $this->sendResponse($pendidikan, 'List Pendidikan Terakhir');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pendidikan = Pendidikan::create([
            'pendidikan_terakhir'  => $request['pendidikan_terakhir'],
        ]);
        return $this->sendResponse($pendidikan, 'Pendidikan Ditambahkan');
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
       $pendidikan = Pendidikan::findOrFail($id);
       // dd($request->namaPendidikan);

       $pendidikan->update($request->all());

        return $this->sendResponse($pendidikan, 'Data Pendidikan Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
       // dd($request->namaPendidikan);

       $pendidikan->update($request->pendidikan_terakhir);

        return $this->sendResponse($pendidikan, 'Data Pendidikan Diubah!');
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

        $pendidikan = Pendidikan::findOrFail($id);
        // delete data Pendidikan

        $pendidikan->delete();

        return $this->sendResponse([$pendidikan], 'Pendidikan sudah dihapus!');
    }
}
