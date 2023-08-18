<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermohonankreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonankredit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('no_ktp',16)->unique();
            $table->string('no_rekening',13)->unique()->nullable();
            $table->string('namafile',200);
            $table->string('tgl_permohonan',20)->nullable();
            $table->string('tgl_setujutolak',20)->nullable();
            $table->string('tgl_pencairan',20)->nullable();
            $table->string('file',200);
            $table->string('file_disetujui',200)->nullable();
            $table->string('file_spk',200)->nullable();
            $table->foreignId('status_id');
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
        Schema::dropIfExists('permohonankredit');
    }
}
