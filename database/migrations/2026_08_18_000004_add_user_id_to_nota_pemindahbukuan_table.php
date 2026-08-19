<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToNotaPemindahbukuanTable extends Migration
{
    public function up()
    {
        Schema::table('nota_pemindahbukuan', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('kantor_id');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('nota_pemindahbukuan', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
