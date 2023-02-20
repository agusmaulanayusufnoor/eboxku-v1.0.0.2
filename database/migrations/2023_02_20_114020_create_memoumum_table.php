<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoumumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memoumum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('no_memo',25);
            $table->string('jenis',50);
            $table->string('tanggal',20);
            $table->string('namafile',250);
            $table->string('file',250);
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
        Schema::dropIfExists('memoumum');
    }
}
