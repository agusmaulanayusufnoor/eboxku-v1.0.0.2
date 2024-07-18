<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@bprku.com')->delete();

        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'type' => 'admin',
            'email' => 'admin@bprku.com',
            'password' =>  Hash::make('12345678'),
            'kantor_id' => '1',
            'otorisator' => '0',
        ]);
    }
}
