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
            $table->string('jenis_pembayaran'); //('Online', 'Offline')
            $table->string('bank');
            $table->string('namaRek');
            $table->integer('total_pembayaran');
            $table->string('bukti_pembayaran');
            $table->string('status', 50)->default('Sedang Diproses'); //('Diterima', 'Dibatalkan')
            $table->string('alasan_pembatalan')->nullable();
            $table->dateTime('expired_at');
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
