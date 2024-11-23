<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Stokbarangctk;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StokbarangctkImport; // Import class yang baru saja dibuat
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StokctkimportController extends BaseController
{
    protected $stokbarangctk = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Stokbarangctk $stokbarangctk)
    {
        $this->middleware('auth:api');
        $this->stokbarangctk = $stokbarangctk;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Validasi file Excel
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // Proses import
        try {
            // Menggunakan Maatwebsite Excel untuk mengimpor data
            Excel::import(new StokbarangctkImport, $request->file('file'));

            // Response berhasil
            return response()->json([
                'message' => 'File berhasil di-upload dan data berhasil diimpor.',
            ]);
        } catch (\Exception $e) {
            // Menangani error jika terjadi masalah selama import
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
