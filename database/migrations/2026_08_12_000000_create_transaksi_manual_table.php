<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiManualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_manual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('nama_file');
            $table->date('tanggal');
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });

        Schema::create('transaksi_manual_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_manual_id')->constrained('transaksi_manual')->onDelete('cascade');
            $table->string('no_rekening');
            $table->string('nama_nasabah');
            $table->bigInteger('pokok')->default(0);
            $table->bigInteger('bunga')->default(0);
            $table->bigInteger('denda')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_manual_details');
        Schema::dropIfExists('transaksi_manual');
    }
}
