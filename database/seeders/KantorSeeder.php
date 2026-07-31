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
            [
                'id' => '7',
                'kode_kantor' => '007',
                'kode_kantor_slik' => '007',
                'nama_kantor' => 'cab. majalengka',
            ],
            [
                'id' => '8',
                'kode_kantor' => '008',
                'kode_kantor_slik' => '008',
                'nama_kantor' => 'cab. panyingkiran',
            ],
            [
                'id' => '9',
                'kode_kantor' => '009',
                'kode_kantor_slik' => '009',
                'nama_kantor' => 'cab. banjaran',
            ],
            [
                'id' => '10',
                'kode_kantor' => '010',
                'kode_kantor_slik' => '010',
                'nama_kantor' => 'cab. cingambul',
            ],
            [
                'id' => '11',
                'kode_kantor' => '011',
                'kode_kantor_slik' => '011',
                'nama_kantor' => 'cab. bekasi',
            ],
            [
                'id' => '12',
                'kode_kantor' => '012',
                'kode_kantor_slik' => '012',
                'nama_kantor' => 'cab. pondok gede',
            ],
            [
                'id' => '13',
                'kode_kantor' => '013',
                'kode_kantor_slik' => '013',
                'nama_kantor' => 'cab. cibitung',
            ],
            [
                'id' => '14',
                'kode_kantor' => '014',
                'kode_kantor_slik' => '014',
                'nama_kantor' => 'cab. setu',
            ],
            [
                'id' => '15',
                'kode_kantor' => '015',
                'kode_kantor_slik' => '015',
                'nama_kantor' => 'cab. cibarusah',
            ],
            [
                'id' => '16',
                'kode_kantor' => '016',
                'kode_kantor_slik' => '016',
                'nama_kantor' => 'cab. sukatani',
            ],
            [
                'id' => '17',
                'kode_kantor' => '017',
                'kode_kantor_slik' => '017',
                'nama_kantor' => 'cab. cimerak',
            ],
            [
                'id' => '18',
                'kode_kantor' => '018',
                'kode_kantor_slik' => '018',
                'nama_kantor' => 'cab. ciamis',
            ],
        ]);
    }
}
