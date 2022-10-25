<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('admin_id')->nullable();
            $table->string('jenis_pembayaran')->default('Online'); //('Online', 'Offline')
            $table->string('bank')->nullable();
            $table->string('namaRek')->nullable();
            $table->integer('total_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status', 50)->default('Menunggu Konfirmasi Pemesanan'); //('Diterima', 'Dibatalkan')
            $table->string('alasan_pembatalan')->nullable();
            $table->dateTime('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
}
