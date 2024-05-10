<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJmlPermohonanAndJmlRealisasiToPermohonankredit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonankredit', function (Blueprint $table) {
            $table->bigInteger('jml_permohonan')->after('tgl_pencairan')->nullable();
            $table->bigInteger('jml_realisasi')->after('jml_permohonan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonankredit', function (Blueprint $table) {
            $table->dropColumn('jml_permohonan');
            $table->dropColumn('jml_realisasi');
        });
    }
}
