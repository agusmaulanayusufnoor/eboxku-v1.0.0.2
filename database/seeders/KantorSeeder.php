<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kode_kantors')->truncate();

        DB::table('kode_kantors')->insert([
            [
                'id' => '1',
                'kode_kantor' => '001',
                'kode_kantor_slik' => '000',
                'nama_kantor' => 'pusat',
            ],
            [
                'id' => '2',
                'kode_kantor' => '002',
                'kode_kantor_slik' => '002',
                'nama_kantor' => 'cab. cisalak',
            ],
            [
                'id' => '3',
                'kode_kantor' => '003',
                'kode_kantor_slik' => '001',
                'nama_kantor' => 'cab. kpo',
            ],
            [
                'id' => '4',
                'kode_kantor' => '004',
                'kode_kantor_slik' => '003',
                'nama_kantor' => 'cab. subang',
            ],
            [
                'id' => '5',
                'kode_kantor' => '005',
                'kode_kantor_slik' => '004',
                'nama_kantor' => 'cab. purwadadi',
            ],
            [
                'id' => '6',
                'kode_kantor' => '006',
                'kode_kantor_slik' => '005',
                'nama_kantor' => 'cab. pamanukan',
            ],
        ]);
    }
}
