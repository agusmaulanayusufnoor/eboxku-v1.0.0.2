<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Statuspajak;
use Illuminate\Http\Request;

class StatuspajakController extends BaseController
{
    protected $statuspajak = '';
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Statuspajak $statuspajak)
    {
        $this->middleware('auth:api');
        $this->statuspajak= $statuspajak;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuspajak  = Statuspajak::get();

        return $this->sendResponse($statuspajak, 'List Status Pajak');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $statuspajak = Statuspajak::create([
            'statuspajak'  => $request['statuspajak'],
        ]);
        return $this->sendResponse($statuspajak, 'Status Pajak Ditambahkan');
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
       $statuspajak = Statuspajak::findOrFail($id);
       // dd($request->namastatuspajak);

       $statuspajak->update($request->all());

        return $this->sendResponse($statuspajak, 'Data Status Pajak Diubah!');
    }
    public function updateData(Request $request, $id)
    {
        $statuspajak = Statuspajak::findOrFail($id);
       // dd($request->namastatuspajak);

       $statuspajak->update($request->statuspajak);

        return $this->sendResponse($statuspajak, 'Data Status Pajak Diubah!');
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

        $statuspajak = Statuspajak::findOrFail($id);
        // delete data statuspajak

        $statuspajak->delete();

        return $this->sendResponse([$statuspajak], 'Status Pajak Sudah Dihapus!');
    }
}
