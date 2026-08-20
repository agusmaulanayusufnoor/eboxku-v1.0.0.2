<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppuTable extends Migration
{
    public function up()
    {
        Schema::create('sppu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id')->constrained('kode_kantors');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('penerima_uang', 150);
            $table->decimal('nominal', 15, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sppu');
    }
}
