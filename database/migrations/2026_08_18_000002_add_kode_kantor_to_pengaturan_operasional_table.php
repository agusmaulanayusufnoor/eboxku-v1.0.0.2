<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeKantorToPengaturanOperasionalTable extends Migration
{
    public function up()
    {
        Schema::table('pengaturan_operasional', function (Blueprint $table) {
            $table->string('kode_kantor', 10)->after('id');
        });
    }

    public function down()
    {
        Schema::table('pengaturan_operasional', function (Blueprint $table) {
            $table->dropColumn('kode_kantor');
        });
    }
}
