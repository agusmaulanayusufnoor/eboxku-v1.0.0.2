<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKotaKantorToKodeKantorsTable extends Migration
{
    public function up()
    {
        Schema::table('kode_kantors', function (Blueprint $table) {
            $table->string('kota_kantor')->nullable()->after('nama_kantor');
        });
    }

    public function down()
    {
        Schema::table('kode_kantors', function (Blueprint $table) {
            $table->dropColumn('kota_kantor');
        });
    }
}
