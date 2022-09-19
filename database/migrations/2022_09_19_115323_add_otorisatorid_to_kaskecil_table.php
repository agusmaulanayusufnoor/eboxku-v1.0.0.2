<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtorisatoridToKaskecilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kaskecil', function (Blueprint $table) {
            $table->foreignId('otorisator_id')->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kaskecil', function (Blueprint $table) {
            $table->dropColumn('otorisator_id');
        });
    }
}
