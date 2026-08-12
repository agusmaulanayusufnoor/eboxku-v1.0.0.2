<?php

namespace App\Exports;

use App\Models\TransaksiManual;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class TransaksiManualExport implements WithEvents
{
    protected $transaksiManualId;

    public function __construct($transaksiManualId)
    {
        $this->transaksiManualId = $transaksiManualId;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $transaksi = TransaksiManual::with('details')->findOrFail($this->transaksiManualId);

                // Tulis header baris 1
                $headers = ['no_rekening', 'pokok', 'bunga', 'denda', 'keterangan'];
                foreach ($headers as $col => $heading) {
                    $sheet->setCellValueExplicitByColumnAndRow(
                        $col + 1, 1, $heading, DataType::TYPE_STRING
                    );
                }

                // Tulis data mulai baris 2
                $rowNum = 2;
                foreach ($transaksi->details as $row) {
                    $keterangan = 'Auto Debet No Rek : ' . $row->no_rekening . ' AN ' . strtoupper($row->nama_nasabah);

                    // no_rekening - string
                    $sheet->setCellValueExplicitByColumnAndRow(1, $rowNum, (string) $row->no_rekening, DataType::TYPE_STRING);

                    // pokok - numeric explisit
                    $sheet->setCellValueExplicitByColumnAndRow(2, $rowNum, intval($row->pokok), DataType::TYPE_NUMERIC);

                    // bunga - numeric explisit (0 tetap 0)
                    $sheet->setCellValueExplicitByColumnAndRow(3, $rowNum, intval($row->bunga), DataType::TYPE_NUMERIC);

                    // denda - numeric explisit (0 tetap 0)
                    $sheet->setCellValueExplicitByColumnAndRow(4, $rowNum, intval($row->denda), DataType::TYPE_NUMERIC);

                    // keterangan - string
                    $sheet->setCellValueExplicitByColumnAndRow(5, $rowNum, $keterangan, DataType::TYPE_STRING);

                    $rowNum++;
                }

                // Set lebar kolom
                $sheet->getColumnDimension('A')->setWidth(22);
                $sheet->getColumnDimension('B')->setWidth(16);
                $sheet->getColumnDimension('C')->setWidth(16);
                $sheet->getColumnDimension('D')->setWidth(16);
                $sheet->getColumnDimension('E')->setWidth(60);
            },
        ];
    }
}
