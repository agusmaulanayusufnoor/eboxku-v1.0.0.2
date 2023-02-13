<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisToRekkoranabaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekkoranaba', function (Blueprint $table) {
            $table->string('jenis',100)->after('kantor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekkoranaba', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}
