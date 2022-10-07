<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis');
            $table->foreignId('kantor_id');
            $table->date('tanggal');
            $table->bigInteger('jml_stok_awal');
            $table->bigInteger('tambahan_stok');
            $table->bigInteger('jml_digunakan');
            $table->bigInteger('jml_rusak');
            $table->bigInteger('jml_hilang');
            $table->bigInteger('jml_stok_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
