<?php

namespace App\Imports;

use App\Models\TransaksiManualDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class TransaksiManualImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    protected $transaksiManualId;

    public function __construct($transaksiManualId)
    {
        $this->transaksiManualId = $transaksiManualId;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TransaksiManualDetail([
            'transaksi_manual_id' => $this->transaksiManualId,
            'no_rekening'         => $row['no_rekening'] ?? $row['no_rekening'] ?? null,
            'nama_nasabah'        => $row['nama_nasabah'] ?? $row['nama_nasabah'] ?? null,
            'pokok'               => $row['pokok'] ?? null,
            'bunga'               => $row['bunga'] ?? null,
            'denda'               => $row['denda'] ?? 0,
        ]);
    }

    /**
     * Rules validasi tiap baris Excel
     */
    public function rules(): array
    {
        return [
            '*.no_rekening'  => ['required'],
            '*.nama_nasabah' => ['required'],
            '*.pokok'        => ['required', 'regex:/^[0-9]+$/'],
            '*.bunga'        => ['required', 'regex:/^[0-9]+$/'],
            '*.denda'        => ['nullable', 'regex:/^[0-9]*$/'],
        ];
    }

    /**
     * Pesan validasi bahasa Indonesia yang jelas dan informatif
     */
    public function customValidationMessages(): array
    {
        return [
            'no_rekening.required'  => 'Kolom "No. Rekening" wajib diisi.',
            'nama_nasabah.required' => 'Kolom "Nama Nasabah" wajib diisi.',
            'pokok.required'        => 'Kolom "Pokok" wajib diisi.',
            'pokok.regex'           => 'Kolom "Pokok" harus berisi angka murni (tanpa koma/titik/karakter lain).',
            'bunga.required'        => 'Kolom "Bunga" wajib diisi.',
            'bunga.regex'           => 'Kolom "Bunga" harus berisi angka murni (tanpa koma/titik/karakter lain).',
            'denda.regex'           => 'Kolom "Denda" harus berisi angka murni (tanpa koma/titik/karakter lain).',
        ];
    }
}
