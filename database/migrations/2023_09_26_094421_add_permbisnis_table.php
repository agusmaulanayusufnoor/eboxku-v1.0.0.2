<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermbisnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permbisnis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('namafile',200);
            $table->string('tgl_permohonan',20)->nullable();
            $table->string('tgl_setujutolak',20)->nullable();
            $table->string('tgl_acc',20)->nullable();
            $table->string('tgl_selesai',20)->nullable();
            $table->string('file',200);
            $table->string('file_memo',200)->nullable();
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
        Schema::dropIfExists('permbisnis');
    }
}
