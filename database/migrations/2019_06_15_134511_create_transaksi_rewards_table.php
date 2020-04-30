<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_rewards', function (Blueprint $table) {
            $table->increments('id');//PK

            $table->integer('id_nasabah')->unsigned();//FK
            $table->integer('id_reward')->unsigned();//FK
            $table->integer('total_point');
            $table->integer('total_jumlah');
            $table->boolean('validasi')->default(0);
            // $table->string('status');//konfirmasi diambil atau belum diambil

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_nasabah')->references('id')->on('nasabahs')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_reward')->references('id')->on('rewards')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_rewards');
    }
}
