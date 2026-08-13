<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Pincab;
use App\Models\Kode_kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PincabController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $pincab = Pincab::orderBy('kode_kantor', 'asc')->get();
        return $this->sendResponse($pincab, 'Daftar Pemimpin Cabang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kantor' => 'required|string',
            'nama_pimpinan' => 'required|string',
        ]);

        $pincab = Pincab::create([
            'kode_kantor' => $request->kode_kantor,
            'nama_pimpinan' => $request->nama_pimpinan,
        ]);

        return $this->sendResponse($pincab, 'Data Pemimpin Cabang Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $pincab = Pincab::findOrFail($id);
        return $this->sendResponse($pincab, 'Data Pemimpin Cabang');
    }

    public function update(Request $request, $id)
    {
        $pincab = Pincab::findOrFail($id);

        $request->validate([
            'kode_kantor' => 'required|string',
            'nama_pimpinan' => 'required|string',
        ]);

        $pincab->update([
            'kode_kantor' => $request->kode_kantor,
            'nama_pimpinan' => $request->nama_pimpinan,
        ]);

        return $this->sendResponse($pincab, 'Data Pemimpin Cabang Berhasil Diubah');
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $pincab = Pincab::findOrFail($id);
        $pincab->delete();

        return $this->sendResponse($pincab, 'Data Pemimpin Cabang Berhasil Dihapus');
    }

    /**
     * Get pincab info based on user login's office
     */
    public function getByUserKantor(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return $this->sendError('Unauthorized', [], 401);
        }

        $kantorId = $user->kantor_id;
        $kodeKantor = null;

        if ($kantorId) {
            $kantor = Kode_kantor::find($kantorId);
            if ($kantor) {
                $kodeKantor = $kantor->kode_kantor ?? $kantor->kode_kantor_slik;
            }
        }

        if (!$kodeKantor && isset($user->kode_kantor)) {
            $kodeKantor = $user->kode_kantor;
        }

        $pincab = null;
        if ($kodeKantor) {
            $paddedKode = str_pad($kodeKantor, 3, '0', STR_PAD_LEFT);
            $pincab = Pincab::where('kode_kantor', $kodeKantor)
                ->orWhere('kode_kantor', $paddedKode)
                ->first();
        }

        return $this->sendResponse([
            'user' => $user,
            'kode_kantor' => $kodeKantor,
            'pincab' => $pincab,
            'nama_pimpinan' => $pincab ? $pincab->nama_pimpinan : '',
        ], 'Pincab user login');
    }
}
