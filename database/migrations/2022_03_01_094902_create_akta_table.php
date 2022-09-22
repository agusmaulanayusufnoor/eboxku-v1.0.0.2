<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('no_akta',25)->unique();
            $table->string('tanggal',20);
            $table->string('namafile',200);
            $table->string('file',200);
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
        Schema::dropIfExists('akta');
    }
}
