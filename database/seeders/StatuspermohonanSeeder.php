<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatuspermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuspermohonan')->truncate();

        DB::table('statuspermohonan')->insert([
            [
                'id' => '1',
                'statuspermohonan' => 'Proses [analisa]',
            ],
            [
                'id' => '2',
                'statuspermohonan' => 'Proses [disetujui]',
            ],
            [
                'id' => '3',
                'namaotorisator' => 'Ditolak',
            ],
            [
                'id' => '4',
                'namaotorisator' => 'Selesai',
            ],
            [
                'id' => '5',
                'namaotorisator' => 'Permohonan',
            ],
            [
                'id' => '6',
                'namaotorisator' => 'Disetujui Bisnis',
            ],
            [
                'id' => '7',
                'namaotorisator' => 'Diproses Operasional',
            ],
        ]);
    }
}
