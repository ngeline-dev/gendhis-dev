<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_order', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('nama_pemesan');
            $table->string('nomor_telepon_pemesan');
            $table->string('nomor_ktp_pemesan');
            $table->string('bi_nama_anak')->nullable();
            $table->string('bi_usia_anak')->nullable();
            $table->date('ft_tanggal_pemesanan')->nullable();
            $table->text('ft_alamat_pemesanan')->nullable();
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
        Schema::dropIfExists('tb_detail_order');
    }
}
