<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjkkendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjkkendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('nopol',20);
            $table->string('tgl_habis_stnk',20);
            $table->string('tgl_pajak_tahunan',20);
            $table->integer('nilai_pajak');
            $table->string('pemegang_kendaraan',250)->nullable();
            $table->string('status_bayar',250);
            $table->string('keterangan',250)->nullable();
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
        Schema::dropIfExists('pjkkendaraan');
    }
}
