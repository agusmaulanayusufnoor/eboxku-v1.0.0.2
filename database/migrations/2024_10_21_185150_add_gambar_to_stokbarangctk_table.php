<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGambarToStokbarangctkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stokbarangctk', function (Blueprint $table) {
            $table->string('file',250)->nullable()->after('keterangan');
            $table->string('view',250)->nullable()->after('file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stokbarangctk', function (Blueprint $table) {
            $table->dropColumn('file'); 
            $table->dropColumn('view'); 
        });
    }
}
