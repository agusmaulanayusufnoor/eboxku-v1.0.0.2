<?php

namespace Database\Seeders;

use App\Models\Otorisator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtorisatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Otorisator')->truncate();

        DB::table('Otorisator')->insert([
            [
                'id' => '1',
                'namaotorisator' => 'M. Noor Rahman [Dirut]',
            ],
            [
                'id' => '2',
                'namaotorisator' => 'Ayip Muhdiatullah [Dirop]',
            ],
            [
                'id' => '3',
                'namaotorisator' => 'Heru Sunaryo [Pindiv]',
            ],
            [
                'id' => '4',
                'namaotorisator' => 'Suherman [Pindiv]',
            ],
            [
                'id' => '5',
                'namaotorisator' => 'Rubi Agustian [Pindiv]',
            ],
            [
                'id' => '6',
                'namaotorisator' => 'Dadan Yunandar RIzal [Pinbag]',
            ],
        ]);
    }
}
