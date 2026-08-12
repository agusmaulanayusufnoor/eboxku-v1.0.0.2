<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\TransaksiManual;
use App\Models\TransaksiManualDetail;
use App\Models\kode_kantor;
use App\Imports\TransaksiManualImport;
use App\Exports\TransaksiManualExport;
use App\Exports\TransaksiManualTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiManualController extends BaseController
{
    protected $transaksiManual = '';

    public function __construct(TransaksiManual $transaksiManual)
    {
        $this->middleware('auth:api');
        $this->transaksiManual = $transaksiManual;
    }

    /**
     * Tampilkan daftar upload transaksi manual.
     */
    public function index(Request $request)
    {
        $user       = Auth::user();
        $kantorId   = $user->kantor_id;
        $levelLogin = $user->type;

        $query = TransaksiManual::select(
                'transaksi_manual.*',
                'kode_kantors.nama_kantor',
                'kode_kantors.kode_kantor'
            )
            ->join('kode_kantors', 'transaksi_manual.kantor_id', '=', 'kode_kantors.id');

        // Scope per kantor untuk non-admin & non-ppk
        if (!in_array($levelLogin, ['admin', 'ppk'])) {
            $query->where('transaksi_manual.kantor_id', $kantorId);
        }

        // Filter tanggal mulai
        if ($request->filled('tgl_mulai')) {
            $query->where('transaksi_manual.tanggal', '>=', $request->tgl_mulai);
        }

        // Filter tanggal akhir
        if ($request->filled('tgl_akhir')) {
            $query->where('transaksi_manual.tanggal', '<=', $request->tgl_akhir);
        }

        // Filter kantor (berlaku untuk admin & ppk)
        if ($request->filled('kantor_id') && in_array($levelLogin, ['admin', 'ppk'])) {
            $query->where('transaksi_manual.kantor_id', $request->kantor_id);
        }

        $data = $query->orderBy('transaksi_manual.created_at', 'desc')->get();

        return $this->sendResponse($data, 'Data transaksi manual berhasil dimuat.');
    }

    /**
     * Upload dan import file Excel transaksi manual.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file'      => 'required|mimes:xlsx|max:5120',
            'kantor_id' => 'required|integer|exists:kode_kantors,id',
        ], [
            'file.mimes'       => 'Format file harus .xlsx. File lain tidak diperbolehkan.',
            'kantor_id.required' => 'Pilih kantor terlebih dahulu.',
            'kantor_id.exists'   => 'Kantor tidak valid.',
        ]);

        $user = Auth::user();

        DB::beginTransaction();
        try {
            // Ambil kode kantor untuk nama file
            $kantor   = kode_kantor::findOrFail($request->kantor_id);
            $file     = $request->file('file');
            $tanggal  = now()->format('Ymd');
            $namaFile = $tanggal . ' - ' . $kantor->kode_kantor;

            $header = TransaksiManual::create([
                'kantor_id' => $request->kantor_id,
                'nama_file' => $namaFile,
                'tanggal'   => now()->format('Y-m-d'),
                'status'    => 'proses',
            ]);

            // Import baris-baris dari Excel
            $import = new TransaksiManualImport($header->id);
            Excel::import($import, $file);

            // Cek apakah ada kegagalan validasi dari baris Excel
            $failures = $import->failures();
            if ($failures->isNotEmpty()) {
                DB::rollBack();

                $errorMessages = [];
                foreach ($failures as $failure) {
                    $rowNum = $failure->row();
                    $attribute = $failure->attribute();
                    $errors = $failure->errors();

                    // Format pesan per baris yang sangat jelas
                    foreach ($errors as $err) {
                        $errorMessages[] = "Baris {$rowNum}: {$err}";
                    }
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Upload gagal! Format data Excel tidak valid:',
                    'errors'  => array_unique($errorMessages),
                ], 422);
            }

            DB::commit();

            return $this->sendResponse($header, 'File berhasil diupload dan data berhasil diimpor dengan status [diproses].');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update status transaksi manual menjadi selesai.
     */
    public function updateStatus(Request $request, $id)
    {
        $transaksi = TransaksiManual::findOrFail($id);
        $transaksi->update(['status' => 'selesai']);

        return $this->sendResponse($transaksi, 'Status berhasil diubah menjadi selesai.');
    }

    /**
     * Download template format Excel untuk upload transaksi manual.
     */
    public function template()
    {
        return Excel::download(new TransaksiManualTemplateExport(), 'format_transaksi_manual.xlsx');
    }

    /**
     * Download data transaksi manual sebagai file Excel.
     * Format nama file: tahunbulanhari_jammenitdetik_[kode_kantor]
     */
    public function export($id)
    {
        $transaksi = TransaksiManual::with('kantor')->findOrFail($id);
        $kodeKantor = $transaksi->kantor ? $transaksi->kantor->kode_kantor : $transaksi->kantor_id;
        $namaFile  = now()->format('Ymd_His') . '_' . $kodeKantor . '.xlsx';

        return Excel::download(new TransaksiManualExport($id), $namaFile);
    }

    /**
     * Tampilkan detail transaksi manual.
     */
    public function show($id)
    {
        $transaksi = TransaksiManual::with(['kantor', 'details'])->findOrFail($id);
        return $this->sendResponse($transaksi, 'Detail transaksi manual berhasil dimuat.');
    }

    /**
     * Laporan summary transaksi manual per kantor per bulan.
     */
    public function laporan(Request $request)
    {
        $query = TransaksiManual::select(
                'kode_kantors.kode_kantor',
                'kode_kantors.nama_kantor',
                DB::raw('COUNT(transaksi_manual.id) as jumlah_file')
            )
            ->join('kode_kantors', 'transaksi_manual.kantor_id', '=', 'kode_kantors.id');

        // Filter bulan (format: YYYY-MM)
        if ($request->filled('bulan')) {
            $query->whereRaw("DATE_FORMAT(transaksi_manual.tanggal, '%Y-%m') = ?", [$request->bulan]);
        }

        // Filter kantor
        if ($request->filled('kantor_id')) {
            $query->where('transaksi_manual.kantor_id', $request->kantor_id);
        }

        $data = $query
            ->groupBy('transaksi_manual.kantor_id', 'kode_kantors.kode_kantor', 'kode_kantors.nama_kantor')
            ->orderBy('kode_kantors.kode_kantor')
            ->get();

        // Hitung total
        $total = $data->sum('jumlah_file');

        return $this->sendResponse([
            'rows'  => $data,
            'total' => $total,
            'bulan' => $request->bulan ?? '',
        ], 'Laporan berhasil dimuat.');
    }

    /**
     * Hapus data transaksi manual beserta detail-nya.
     */
    public function destroy($id)
    {
        $transaksi = TransaksiManual::findOrFail($id);
        $transaksi->details()->delete();
        $transaksi->delete();

        return $this->sendResponse([], 'Data transaksi manual berhasil dihapus.');
    }
}
