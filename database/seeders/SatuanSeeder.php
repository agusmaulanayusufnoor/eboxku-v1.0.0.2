<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuan')->truncate();

        DB::table('satuan')->insert([
            [
                'id' => 1,
                'namasatuan' => 'Blok',
                'created_at' => '2024-10-15 17:19:54',
                'updated_at' => '2024-10-15 17:19:54',
            ],
            [
                'id' => 2,
                'namasatuan' => 'Pack',
                'created_at' => '2024-10-17 10:04:44',
                'updated_at' => '2024-10-17 10:05:13',
            ],
            [
                'id' => 3,
                'namasatuan' => 'Buah',
                'created_at' => '2024-10-17 10:05:27',
                'updated_at' => '2024-10-17 10:05:27',
            ],
            [
                'id' => 4,
                'namasatuan' => 'Rim',
                'created_at' => '2024-10-17 10:05:41',
                'updated_at' => '2024-10-17 10:05:41',
            ],
            [
                'id' => 5,
                'namasatuan' => 'Set',
                'created_at' => '2024-10-17 10:20:17',
                'updated_at' => '2024-10-17 10:20:17',
            ],
            [
                'id' => 6,
                'namasatuan' => 'Pcs',
                'created_at' => '2024-10-17 10:20:36',
                'updated_at' => '2024-10-17 10:20:36',
            ],
            [
                'id' => 7,
                'namasatuan' => 'Ikat',
                'created_at' => '2024-10-17 10:20:47',
                'updated_at' => '2024-10-17 10:20:47',
            ],
            [
                'id' => 8,
                'namasatuan' => 'Lembar',
                'created_at' => '2024-10-17 10:21:00',
                'updated_at' => '2024-10-17 10:21:00',
            ],
            [
                'id' => 9,
                'namasatuan' => 'Box',
                'created_at' => '2024-10-17 10:21:14',
                'updated_at' => '2024-10-17 10:21:14',
            ],
        ]);
    }
}
