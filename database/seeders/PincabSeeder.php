<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PincabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kode_kantor' => '001', 'nama_pimpinan' => 'R. MOHAMAD NOOR RAHMAN, SH, MH'],
            ['kode_kantor' => '002', 'nama_pimpinan' => 'ETI ROHAETI'],
            ['kode_kantor' => '003', 'nama_pimpinan' => 'IWAN NURAHMAN'],
            ['kode_kantor' => '004', 'nama_pimpinan' => 'CAHYA SUDRAJAT'],
            ['kode_kantor' => '005', 'nama_pimpinan' => 'IAN SOPIYAN'],
            ['kode_kantor' => '006', 'nama_pimpinan' => 'OOM ROMLAH'],
            ['kode_kantor' => '007', 'nama_pimpinan' => 'PIPIH PUSPITASARI'],
            ['kode_kantor' => '008', 'nama_pimpinan' => 'UJANG CASMITA'],
            ['kode_kantor' => '009', 'nama_pimpinan' => 'ALI SUHALI'],
            ['kode_kantor' => '010', 'nama_pimpinan' => 'JOJO TARJO'],
            ['kode_kantor' => '011', 'nama_pimpinan' => 'INDRA ARIFUDIN'],
            ['kode_kantor' => '012', 'nama_pimpinan' => 'INDRA ARIFUDIN'],
            ['kode_kantor' => '013', 'nama_pimpinan' => 'NONO TARYONO'],
            ['kode_kantor' => '014', 'nama_pimpinan' => 'NUNUNG NURHAENI'],
            ['kode_kantor' => '015', 'nama_pimpinan' => 'ASEP DODI'],
            ['kode_kantor' => '016', 'nama_pimpinan' => 'BUDI ARLAN ADITYA'],
            ['kode_kantor' => '017', 'nama_pimpinan' => 'KATIH, S.IP'],
            ['kode_kantor' => '018', 'nama_pimpinan' => 'IIK MULYONO'],
        ];

        foreach ($data as $row) {
            DB::table('pincab')->updateOrInsert(
                ['kode_kantor' => $row['kode_kantor']],
                [
                    'nama_pimpinan' => $row['nama_pimpinan'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
