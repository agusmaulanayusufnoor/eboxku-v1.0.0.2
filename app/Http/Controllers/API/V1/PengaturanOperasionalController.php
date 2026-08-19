<?php

namespace App\Http\Controllers\API\V1;

use App\Models\PengaturanOperasional;
use Illuminate\Http\Request;

class PengaturanOperasionalController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = PengaturanOperasional::orderBy('kode_kantor', 'asc')
            ->orderBy('jabatan', 'asc')
            ->get();
        return $this->sendResponse($data, 'Daftar Pengaturan Operasional');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kantor' => 'required|string|max:10',
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $data = PengaturanOperasional::create([
            'kode_kantor' => $request->kode_kantor,
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
        ]);

        return $this->sendResponse($data, 'Data Pengaturan Operasional Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $data = PengaturanOperasional::findOrFail($id);
        return $this->sendResponse($data, 'Data Pengaturan Operasional');
    }

    public function update(Request $request, $id)
    {
        $data = PengaturanOperasional::findOrFail($id);

        $request->validate([
            'kode_kantor' => 'required|string|max:10',
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        $data->update([
            'kode_kantor' => $request->kode_kantor,
            'jabatan' => $request->jabatan,
            'nama' => $request->nama,
        ]);

        return $this->sendResponse($data, 'Data Pengaturan Operasional Berhasil Diubah');
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $data = PengaturanOperasional::findOrFail($id);
        $data->delete();

        return $this->sendResponse($data, 'Data Pengaturan Operasional Berhasil Dihapus');
    }
}
