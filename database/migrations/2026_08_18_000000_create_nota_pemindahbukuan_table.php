<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaPemindahbukuanTable extends Migration
{
    public function up()
    {
        Schema::create('nota_pemindahbukuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id')->constrained('kode_kantors');
            $table->enum('jenis_transaksi', [
                'Setoran Tabungan',
                'Transfer Antar Rekening',
                'Titipan Transfer',
                'Anggaran',
                'Rekonsiliasi',
                'Antar Kantor',
                'Amortisasi',
            ]);
            $table->decimal('nominal', 15, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nota_pemindahbukuan');
    }
}
