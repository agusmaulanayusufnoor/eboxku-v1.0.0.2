<?php

namespace Database\Seeders;

use App\Models\Statuspermohonan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(KantorSeeder::class);
        $this->call(OtorisatorSeeder::class);
        $this->call(StatuspermohonanSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        //$this->call(TagsTableSeeder::class);
        //$this->call(ProductsTableSeeder::class);
        //duplicate product for data
        //$this->call(ProductsTableSeeder::class);
    }
}
