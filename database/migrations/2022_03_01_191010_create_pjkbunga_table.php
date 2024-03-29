<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjkbungaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjkbunga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('namafile',200);
            $table->string('tanggal',30);
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
        Schema::dropIfExists('pjkbunga');
    }
}
