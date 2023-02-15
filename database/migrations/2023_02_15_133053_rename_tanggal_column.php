<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTanggalColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pk', function (Blueprint $table) {
            $table->renameColumn('tanggal', 'tglmulai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pk', function (Blueprint $table) {
            $table->renameColumn('tglmulai', 'tanggal');
        });
    }
}
