<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjkpph4ayat2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pjkpph4ayat2', function (Blueprint $table) {
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
        Schema::dropIfExists('pjkpph4ayat2');
    }
}
