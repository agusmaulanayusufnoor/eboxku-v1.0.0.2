<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Otorisator;
use Illuminate\Http\Request;

class OtorisatorController extends BaseController
{
    protected $otorisator = '';
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Otorisator $otorisator)
    {
        $this->middleware('auth:api');
        $this->otorisator= $otorisator;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otorisator  = Otorisator::get();

        return $this->sendResponse($otorisator, 'List Nama Otorisator');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $otorisator = Otorisator::create([
            'namaotorisator'  => $request['namaotorisator'],
        ]);
        return $this->sendResponse($otorisator, 'Otorisator Ditambahkan');
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
       $otorisator = Otorisator::findOrFail($id);
       // dd($request->namaotorisator);

       $otorisator->update($request->all());

        return $this->sendResponse($otorisator, 'Data Otorisator Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $otorisator = Otorisator::findOrFail($id);
       // dd($request->namaotorisator);

       $otorisator->update($request->namaotorisator);

        return $this->sendResponse($otorisator, 'Data Otorisator Diubah!');
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

        $otorisator = Otorisator::findOrFail($id);
        // delete data otorisator

        $otorisator->delete();

        return $this->sendResponse([$otorisator], 'Otorisator sudah dihapus!');
    }
}
