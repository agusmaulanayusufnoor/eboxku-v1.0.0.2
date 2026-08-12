<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiManualTemplateExport implements FromArray, WithHeadings, WithColumnWidths, WithStyles
{
    /**
     * Template kosong tanpa baris contoh (sesuai gambar).
     */
    public function array(): array
    {
        return [];
    }

    /**
     * Header kolom template persis seperti gambar user.
     */
    public function headings(): array
    {
        return [
            'No. Rekening',
            'nama nasabah',
            'Pokok',
            'Bunga',
            'Denda',
        ];
    }

    /**
     * Lebar kolom agar mudah dibaca.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20, // No. Rekening
            'B' => 30, // nama nasabah
            'C' => 15, // Pokok
            'D' => 15, // Bunga
            'E' => 15, // Denda
        ];
    }

    /**
     * Style header tebal (bold).
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }
}
