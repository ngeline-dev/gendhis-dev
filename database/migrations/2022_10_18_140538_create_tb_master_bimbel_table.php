<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMasterBimbelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_master_bimbel', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->string('nama_paket');
            $table->text('deskripsi_paket');
            $table->text('foto_paket');
            $table->integer('harga_paket');
            $table->string('jadwal_bimbel');
            $table->string('waktu_bimbel');
            $table->string('status', 50)->default('Aktif'); //('Aktif', 'Tidak')
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
        Schema::dropIfExists('tb_master_bimbel');
    }
}
