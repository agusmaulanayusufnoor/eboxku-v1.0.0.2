<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokbarangpromosiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stokbarangpromosi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('periode',20);
            $table->foreignId('barang_id');
            $table->foreignId('satuan_id');
            $table->bigInteger('harga_satuan');
            $table->integer('stok_awal');
            $table->integer('stok_masuk');
            $table->integer('stok_keluar');
            $table->integer('stok_akhir');
            $table->bigInteger('nom_awal');
            $table->bigInteger('nom_masuk');
            $table->bigInteger('nom_keluar');
            $table->bigInteger('nom_akhir');
            $table->string('keterangan',100);
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
        Schema::dropIfExists('stokbarangpromosi');
    }
}
