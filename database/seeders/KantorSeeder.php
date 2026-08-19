<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KantorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1,  'kode_kantor' => '001', 'kode_kantor_slik' => '000', 'kode_cabang' => '001', 'nama_kantor' => 'pusat',        'kota_kantor' => 'Subang'],
            ['id' => 2,  'kode_kantor' => '002', 'kode_kantor_slik' => '002', 'kode_cabang' => '003', 'nama_kantor' => 'cab. cisalak',  'kota_kantor' => 'Subang'],
            ['id' => 3,  'kode_kantor' => '003', 'kode_kantor_slik' => '001', 'kode_cabang' => '002', 'nama_kantor' => 'cab. kpo',      'kota_kantor' => 'Subang'],
            ['id' => 4,  'kode_kantor' => '004', 'kode_kantor_slik' => '003', 'kode_cabang' => '004', 'nama_kantor' => 'cab. subang',   'kota_kantor' => 'Subang'],
            ['id' => 5,  'kode_kantor' => '005', 'kode_kantor_slik' => '004', 'kode_cabang' => '005', 'nama_kantor' => 'cab. purwadadi','kota_kantor' => 'Subang'],
            ['id' => 6,  'kode_kantor' => '006', 'kode_kantor_slik' => '005', 'kode_cabang' => '006', 'nama_kantor' => 'cab. pamanukan','kota_kantor' => 'Subang'],
            ['id' => 7,  'kode_kantor' => '007', 'kode_kantor_slik' => '007', 'kode_cabang' => '007', 'nama_kantor' => 'cab. majalengka','kota_kantor' => 'Majalengka'],
            ['id' => 8,  'kode_kantor' => '008', 'kode_kantor_slik' => '008', 'kode_cabang' => '008', 'nama_kantor' => 'cab. panyingkiran','kota_kantor' => 'Majalengka'],
            ['id' => 9,  'kode_kantor' => '009', 'kode_kantor_slik' => '009', 'kode_cabang' => '009', 'nama_kantor' => 'cab. banjaran', 'kota_kantor' => 'Majalengka'],
            ['id' => 10, 'kode_kantor' => '010', 'kode_kantor_slik' => '010', 'kode_cabang' => '010', 'nama_kantor' => 'cab. cingambul','kota_kantor' => 'Majalengka'],
            ['id' => 11, 'kode_kantor' => '011', 'kode_kantor_slik' => '011', 'kode_cabang' => '011', 'nama_kantor' => 'cab. bekasi',   'kota_kantor' => 'Kab Bekasi'],
            ['id' => 12, 'kode_kantor' => '012', 'kode_kantor_slik' => '012', 'kode_cabang' => '012', 'nama_kantor' => 'cab. pondok gede','kota_kantor' => 'Kota Bekasi'],
            ['id' => 13, 'kode_kantor' => '013', 'kode_kantor_slik' => '013', 'kode_cabang' => '013', 'nama_kantor' => 'cab. cibitung', 'kota_kantor' => 'Kab Bekasi'],
            ['id' => 14, 'kode_kantor' => '014', 'kode_kantor_slik' => '014', 'kode_cabang' => '014', 'nama_kantor' => 'cab. setu',     'kota_kantor' => 'Kab Bekasi'],
            ['id' => 15, 'kode_kantor' => '015', 'kode_kantor_slik' => '015', 'kode_cabang' => '015', 'nama_kantor' => 'cab. cibarusah','kota_kantor' => 'Kab Bekasi'],
            ['id' => 16, 'kode_kantor' => '016', 'kode_kantor_slik' => '016', 'kode_cabang' => '016', 'nama_kantor' => 'cab. sukatani', 'kota_kantor' => 'Kab Bekasi'],
            ['id' => 17, 'kode_kantor' => '017', 'kode_kantor_slik' => '017', 'kode_cabang' => '017', 'nama_kantor' => 'cab. cimerak',  'kota_kantor' => 'Kab Pangandaran'],
            ['id' => 18, 'kode_kantor' => '018', 'kode_kantor_slik' => '018', 'kode_cabang' => '018', 'nama_kantor' => 'cab. ciamis',   'kota_kantor' => 'Kab Ciamis'],
        ];

        foreach ($data as $row) {
            DB::table('kode_kantors')->updateOrInsert(
                ['kode_kantor' => $row['kode_kantor']],
                $row
            );
        }
    }
}
