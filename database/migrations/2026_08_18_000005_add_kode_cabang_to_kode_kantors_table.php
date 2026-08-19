<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeCabangToKodeKantorsTable extends Migration
{
    public function up()
    {
        Schema::table('kode_kantors', function (Blueprint $table) {
            $table->string('kode_cabang')->nullable()->after('kode_kantor_slik');
        });
    }

    public function down()
    {
        Schema::table('kode_kantors', function (Blueprint $table) {
            $table->dropColumn('kode_cabang');
        });
    }
}
