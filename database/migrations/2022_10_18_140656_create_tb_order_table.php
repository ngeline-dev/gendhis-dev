<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_order', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->integer('users_id');
            $table->integer('admin_id')->nullable();
            $table->string('status', 50)->default('Sedang Diproses'); //('Diterima', 'Dibatalkan')
            $table->string('alasan_pembatalan')->nullable();
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
        Schema::dropIfExists('tb_order');
    }
}
