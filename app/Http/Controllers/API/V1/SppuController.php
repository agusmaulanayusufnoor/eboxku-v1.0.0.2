<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Sppu;
use App\Models\Kode_kantor;
use App\Models\Pincab;
use App\Models\PengaturanOperasional;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\Terbilang;

class SppuController extends BaseController
{
    protected $sppu = '';

    public function __construct(Sppu $sppu)
    {
        $this->middleware('auth:api');
        $this->sppu = $sppu;
    }

    private function baseQuery()
    {
        return DB::table('sppu')
            ->join('kode_kantors', 'sppu.kantor_id', '=', 'kode_kantors.id')
            ->leftJoin('users', 'sppu.user_id', '=', 'users.id')
            ->select(
                'sppu.id',
                'sppu.penerima_uang',
                'sppu.nominal',
                'sppu.keterangan',
                'sppu.kantor_id',
                'sppu.user_id',
                'kode_kantors.kode_kantor',
                'kode_kantors.kode_cabang',
                'kode_kantors.nama_kantor',
                'kode_kantors.kota_kantor',
                'users.name as user_name',
                'sppu.created_at'
            );
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->type === 'admin') {
            $sppu = $this->baseQuery()
                ->orderBy('sppu.id', 'desc')
                ->get();
        } else {
            $sppu = $this->baseQuery()
                ->where('sppu.user_id', $user->id)
                ->orderBy('sppu.id', 'desc')
                ->get();
        }

        return $this->sendResponse($sppu, 'sppu list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'penerima_uang' => 'required|string|max:150',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'penerima_uang.required' => 'Penerima uang harus diisi',
            'penerima_uang.string' => 'Penerima uang tidak valid',
            'penerima_uang.max' => 'Penerima uang maksimal 150 karakter',
            'nominal.required' => 'Nominal harus diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
        ]);

        $sppu = $this->sppu->create([
            'kantor_id'     => Auth::user()->kantor_id,
            'user_id'       => Auth::id(),
            'penerima_uang' => $request->penerima_uang,
            'nominal'       => $request->nominal,
            'keterangan'    => $request->keterangan,
        ]);

        return $this->sendResponse($sppu, 'SPPU berhasil ditambahkan');
    }

    public function show($id)
    {
        $sppu = $this->baseQuery()
            ->where('sppu.id', $id)
            ->first();

        if (!$sppu) {
            return $this->sendError('Data tidak ditemukan');
        }

        return $this->sendResponse($sppu, 'SPPU');
    }

    public function update(Request $request, $id)
    {
        $sppu = $this->sppu->findOrFail($id);

        $request->validate([
            'penerima_uang' => 'required|string|max:150',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'penerima_uang.required' => 'Penerima uang harus diisi',
            'penerima_uang.string' => 'Penerima uang tidak valid',
            'penerima_uang.max' => 'Penerima uang maksimal 150 karakter',
            'nominal.required' => 'Nominal harus diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
        ]);

        $sppu->update([
            'penerima_uang' => $request->penerima_uang,
            'nominal'       => $request->nominal,
            'keterangan'    => $request->keterangan,
        ]);

        return $this->sendResponse($sppu, 'SPPU berhasil diubah');
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $sppu = $this->sppu->findOrFail($id);
        $sppu->delete();

        return $this->sendResponse($sppu, 'SPPU berhasil dihapus');
    }

    public function cetak($id, Request $request)
    {
        $sppu = $this->baseQuery()
            ->where('sppu.id', $id)
            ->first();

        if (!$sppu) {
            return $this->sendError('Data tidak ditemukan');
        }

        $sppuUser = User::find($sppu->user_id);
        $levelLogin = $sppuUser ? $sppuUser->type : '';
        $userName   = $sppuUser ? $sppuUser->name : '';

        $kodeKantor = str_pad($sppu->kode_kantor, 3, '0', STR_PAD_LEFT);
        $kodeCabang = $sppu->kode_cabang ?? $kodeKantor;

        $pincab = Pincab::where('kode_kantor', $kodeCabang)->first();

        $pengaturan = PengaturanOperasional::where('kode_kantor', $kodeCabang)->get();
        $pimpinanDivisiOperasional = '';
        $manajerOperasional = '';
        foreach ($pengaturan as $p) {
            if (stripos($p->jabatan, 'Pimpinan Divisi Operasional') !== false) {
                $pimpinanDivisiOperasional = $p->nama;
            }
            if (stripos($p->jabatan, 'Manajer Operasional') !== false) {
                $manajerOperasional = $p->nama;
            }
        }

        $data = [
            'nota' => $sppu,
            'kodeKantor' => $kodeKantor,
            'namaKantor' => $sppu->nama_kantor,
            'kotaKantor' => $sppu->kota_kantor ?? '',
            'tanggal' => $this->tanggalIndo($sppu->created_at),
            'nominalRupiah' => $this->formatRupiah($sppu->nominal),
            'pincab' => $pincab ? $pincab->nama_pimpinan : '',
            'stafTeller' => $userName,
            'pimpinanDivisi' => $pimpinanDivisiOperasional,
            'manajerOperasional' => $manajerOperasional,
            'user' => $sppuUser,
            'terbilang' => Terbilang::convert($sppu->nominal),
        ];

        if ($levelLogin === 'pelayanan') {
            $view = 'pdf.sppu.pelayanan';
        } elseif ($levelLogin === 'teller' && $kodeKantor === '001') {
            $view = 'pdf.sppu.teller-kpno';
        } else {
            $view = 'pdf.sppu.teller';
        }

        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('a4', 'portrait');

        $filename = 'sppu_' . date('d-m-Y', strtotime($sppu->created_at)) . '_' . date('H-i-s', strtotime($sppu->created_at)) . '.pdf';
        return $pdf->download($filename);
    }

    public function filter(Request $request)
    {
        $user = Auth::user();
        $query = $this->baseQuery();

        if ($user->type !== 'admin') {
            $query->where('sppu.user_id', $user->id);
        }

        if ($request->filled('nama_kantor') && $user->type === 'admin') {
            $query->where('kode_kantors.nama_kantor', $request->nama_kantor);
        }

        if ($request->filled('penerima_uang')) {
            $query->where('sppu.penerima_uang', $request->penerima_uang);
        }

        if ($request->filled('tgl_awal')) {
            $query->whereDate('sppu.created_at', '>=', $request->tgl_awal);
        }

        if ($request->filled('tgl_akhir')) {
            $query->whereDate('sppu.created_at', '<=', $request->tgl_akhir);
        }

        $sppu = $query->orderBy('sppu.id', 'desc')->get();

        return $this->sendResponse($sppu, 'sppu list');
    }

    public function filterkantor(Request $request)
    {
        $nama_kantor = $request->kantor_id;
        $user = Auth::user();

        if ($user->type === 'admin') {
            $sppu = $this->baseQuery()
                ->where('kode_kantors.nama_kantor', $nama_kantor)
                ->orderBy('sppu.id', 'desc')
                ->get();
        } else {
            $sppu = collect();
        }

        return $this->sendResponse($sppu, 'sppu list');
    }

    function formatRupiah($angka)
    {
        $hasil = number_format($angka, 2, ',', '.');
        return $hasil;
    }

    function tanggalIndo($tanggal)
    {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $day = date('d', strtotime($tanggal));
        $month = (int) date('m', strtotime($tanggal));
        $year = date('Y', strtotime($tanggal));
        return $day . ' ' . $bulan[$month] . ' ' . $year;
    }
}
