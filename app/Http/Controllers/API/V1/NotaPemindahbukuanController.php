<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\NotaPemindahbukuan;
use App\Models\Kode_kantor;
use App\Models\Pincab;
use App\Models\PengaturanOperasional;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaPemindahbukuanController extends BaseController
{
    protected $nota = '';

    public function __construct(NotaPemindahbukuan $nota)
    {
        $this->middleware('auth:api');
        $this->nota = $nota;
    }

    private function baseQuery()
    {
        return DB::table('nota_pemindahbukuan')
            ->join('kode_kantors', 'nota_pemindahbukuan.kantor_id', '=', 'kode_kantors.id')
            ->leftJoin('users', 'nota_pemindahbukuan.user_id', '=', 'users.id')
            ->select(
                'nota_pemindahbukuan.id',
                'nota_pemindahbukuan.jenis_transaksi',
                'nota_pemindahbukuan.nominal',
                'nota_pemindahbukuan.keterangan',
                'nota_pemindahbukuan.kantor_id',
                'nota_pemindahbukuan.user_id',
                'kode_kantors.kode_kantor',
                'kode_kantors.kode_cabang',
                'kode_kantors.nama_kantor',
                'kode_kantors.kota_kantor',
                'users.name as user_name',
                'nota_pemindahbukuan.created_at'
            );
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->type === 'admin') {
            $nota = $this->baseQuery()
                ->orderBy('nota_pemindahbukuan.id', 'desc')
                ->get();
        } else {
            $nota = $this->baseQuery()
                ->where('nota_pemindahbukuan.user_id', $user->id)
                ->orderBy('nota_pemindahbukuan.id', 'desc')
                ->get();
        }

        return $this->sendResponse($nota, 'nota pemindahbukuan list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_transaksi' => 'required|in:Setoran Tabungan,Transfer Antar Rekening,Titipan Transfer,Anggaran,Rekonsiliasi,Antar Kantor,Amortisasi',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'jenis_transaksi.required' => 'Jenis transaksi harus diisi',
            'jenis_transaksi.in' => 'Jenis transaksi tidak valid',
            'nominal.required' => 'Nominal harus diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
        ]);

        $nota = $this->nota->create([
            'kantor_id'       => Auth::user()->kantor_id,
            'user_id'         => Auth::id(),
            'jenis_transaksi' => $request->jenis_transaksi,
            'nominal'         => $request->nominal,
            'keterangan'      => $request->keterangan,
        ]);

        return $this->sendResponse($nota, 'Nota Pemindahbukuan berhasil ditambahkan');
    }

    public function show($id)
    {
        $nota = $this->baseQuery()
            ->where('nota_pemindahbukuan.id', $id)
            ->first();

        if (!$nota) {
            return $this->sendError('Data tidak ditemukan');
        }

        return $this->sendResponse($nota, 'Nota Pemindahbukuan');
    }

    public function update(Request $request, $id)
    {
        $nota = $this->nota->findOrFail($id);

        $request->validate([
            'jenis_transaksi' => 'required|in:Setoran Tabungan,Transfer Antar Rekening,Titipan Transfer,Anggaran,Rekonsiliasi,Antar Kantor,Amortisasi',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'jenis_transaksi.required' => 'Jenis transaksi harus diisi',
            'jenis_transaksi.in' => 'Jenis transaksi tidak valid',
            'nominal.required' => 'Nominal harus diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
        ]);

        $nota->update([
            'jenis_transaksi' => $request->jenis_transaksi,
            'nominal'         => $request->nominal,
            'keterangan'      => $request->keterangan,
        ]);

        return $this->sendResponse($nota, 'Nota Pemindahbukuan berhasil diubah');
    }

    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $nota = $this->nota->findOrFail($id);
        $nota->delete();

        return $this->sendResponse($nota, 'Nota Pemindahbukuan berhasil dihapus');
    }

    public function cetak($id, Request $request)
    {
        $nota = $this->baseQuery()
            ->where('nota_pemindahbukuan.id', $id)
            ->first();

        if (!$nota) {
            return $this->sendError('Data tidak ditemukan');
        }

        $notaUser = User::find($nota->user_id);
        $levelLogin = $notaUser ? $notaUser->type : '';
        $userName   = $notaUser ? $notaUser->name : '';

        $kodeKantor = str_pad($nota->kode_kantor, 3, '0', STR_PAD_LEFT);
        $kodeCabang = $nota->kode_cabang ?? $kodeKantor;

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
            'nota' => $nota,
            'kodeKantor' => $kodeKantor,
            'namaKantor' => $nota->nama_kantor,
            'kotaKantor' => $nota->kota_kantor ?? '',
            'tanggal' => $this->tanggalIndo($nota->created_at),
            'nominalRupiah' => $this->formatRupiah($nota->nominal),
            'pincab' => $pincab ? $pincab->nama_pimpinan : '',
            'stafTeller' => $userName,
            'pimpinanDivisi' => $pimpinanDivisiOperasional,
            'manajerOperasional' => $manajerOperasional,
            'user' => $notaUser,
        ];

        if ($levelLogin === 'pelayanan') {
            $view = 'pdf.nota-pemindahbukuan.pelayanan';
        } elseif ($levelLogin === 'teller' && $kodeKantor === '001') {
            $view = 'pdf.nota-pemindahbukuan.teller-kpno';
        } else {
            $view = 'pdf.nota-pemindahbukuan.teller';
        }

        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('a4', 'portrait');

        $filename = 'nota_' . date('d-m-Y', strtotime($nota->created_at)) . '_' . date('H-i-s', strtotime($nota->created_at)) . '.pdf';
        return $pdf->download($filename);
    }

    public function filter(Request $request)
    {
        $user = Auth::user();
        $query = $this->baseQuery();

        if ($user->type !== 'admin') {
            $query->where('nota_pemindahbukuan.user_id', $user->id);
        }

        if ($request->filled('nama_kantor') && $user->type === 'admin') {
            $query->where('kode_kantors.nama_kantor', $request->nama_kantor);
        }

        if ($request->filled('jenis_transaksi')) {
            $query->where('nota_pemindahbukuan.jenis_transaksi', $request->jenis_transaksi);
        }

        if ($request->filled('tgl_awal')) {
            $query->whereDate('nota_pemindahbukuan.created_at', '>=', $request->tgl_awal);
        }

        if ($request->filled('tgl_akhir')) {
            $query->whereDate('nota_pemindahbukuan.created_at', '<=', $request->tgl_akhir);
        }

        $nota = $query->orderBy('nota_pemindahbukuan.id', 'desc')->get();

        return $this->sendResponse($nota, 'nota pemindahbukuan list');
    }

    public function filterkantor(Request $request)
    {
        $nama_kantor = $request->kantor_id;
        $user = Auth::user();

        if ($user->type === 'admin') {
            $nota = $this->baseQuery()
                ->where('kode_kantors.nama_kantor', $nama_kantor)
                ->orderBy('nota_pemindahbukuan.id', 'desc')
                ->get();
        } else {
            $nota = collect();
        }

        return $this->sendResponse($nota, 'nota pemindahbukuan list');
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
