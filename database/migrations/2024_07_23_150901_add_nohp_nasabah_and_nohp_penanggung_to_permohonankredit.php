<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNohpNasabahAndNohpPenanggungToPermohonankredit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonankredit', function (Blueprint $table) {
            $table->string('nohp_nasabah', 15)->nullable();
            $table->string('nohp_penanggung', 15)->nullable();
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
            $table->dropColumn('nohp_nasabah');
            $table->dropColumn('nohp_penanggung');
        });
    }
}
