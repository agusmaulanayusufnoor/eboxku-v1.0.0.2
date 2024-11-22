<?php

namespace App\Imports;

use App\Models\Stokbarangctk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StokbarangctkImport implements ToModel, WithStartRow
{
    /**
     * Menentukan baris pertama yang akan diproses (biasanya baris pertama adalah header)
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Mengabaikan baris pertama (header)
    }

    /**
     * Mengonversi setiap baris Excel menjadi instance model Stokbarangctk
     *
     * @param array $row
     * @return Stokbarangctk
     */
    public function model(array $row)
    {
        try {
            // Pastikan data kolom Excel dipetakan dengan benar
            return new Stokbarangctk([
                'kantor_id'    => $row[0],
                'periode'      => $row[1],
                'barang_id'    => $row[2],
                'satuan_id'    => $row[3],
                'harga_satuan' => $row[4],
                'stok_awal'    => $row[5],
                'stok_masuk'   => $row[6],
                'stok_keluar'  => $row[7],
                'stok_akhir'   => $row[8],
                'nom_awal'     => $row[9],
                'nom_masuk'    => $row[10],
                'nom_keluar'   => $row[11],
                'nom_akhir'    => $row[12],
                'keterangan'   => $row[13],
                'file'         => null,
                'view'         => null,
            ]);
        } catch (\Exception $e) {
            // Menangani error jika ada data yang tidak valid
            \Log::error("Import error: " . $e->getMessage());
            return null;
        }
    }
}
