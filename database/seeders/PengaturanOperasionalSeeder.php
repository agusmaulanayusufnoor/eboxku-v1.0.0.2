<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanOperasionalSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengaturan_operasional')->truncate();

        $data = [
            // Pimpinan Divisi Operasional
            ['kode_kantor' => '001', 'jabatan' => 'Pimpinan Divisi Operasional', 'nama' => 'HERU SUNARYO', 'created_at' => now(), 'updated_at' => now()],

            // Manajer Operasional
            ['kode_kantor' => '001', 'jabatan' => 'Manajer Operasional', 'nama' => 'Wulantini Purnama', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '002', 'jabatan' => 'Manajer Operasional', 'nama' => 'Neni Listiani', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '003', 'jabatan' => 'Manajer Operasional', 'nama' => 'Tina Kustina', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '004', 'jabatan' => 'Manajer Operasional', 'nama' => 'Enci Maryani', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '005', 'jabatan' => 'Manajer Operasional', 'nama' => 'Dwi Febrianti', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '006', 'jabatan' => 'Manajer Operasional', 'nama' => 'Nirawaty Rismaya', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '007', 'jabatan' => 'Manajer Operasional', 'nama' => 'NINA ANJARWATI', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '008', 'jabatan' => 'Manajer Operasional', 'nama' => 'DIAN MUSTIKASARI', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '009', 'jabatan' => 'Manajer Operasional', 'nama' => 'Titi Nurhayati', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '010', 'jabatan' => 'Manajer Operasional', 'nama' => 'Ruli Padli', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '011', 'jabatan' => 'Manajer Operasional', 'nama' => 'YUMNA AMELIA', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '012', 'jabatan' => 'Manajer Operasional', 'nama' => 'INUY MULYANIA', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '013', 'jabatan' => 'Manajer Operasional', 'nama' => 'Ery Andrini', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '014', 'jabatan' => 'Manajer Operasional', 'nama' => 'NOVIYANTI NOVITA', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '015', 'jabatan' => 'Manajer Operasional', 'nama' => 'ADE HAMIDAH', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '016', 'jabatan' => 'Manajer Operasional', 'nama' => 'FITRIA FEBRIYANI', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '017', 'jabatan' => 'Manajer Operasional', 'nama' => 'YANI YULIANTI', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kantor' => '018', 'jabatan' => 'Manajer Operasional', 'nama' => 'Pristina Meilani', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('pengaturan_operasional')->insert($data);
    }
}
