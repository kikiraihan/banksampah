<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiSampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_sampahs', function (Blueprint $table) {
            $table->increments('id');//PK

            $table->integer('id_nasabah')->unsigned();//FK
            $table->integer('id_sampah')->unsigned();//FK
            $table->integer('total_pembayaran');
            $table->integer('total_jumlah');//total_jumlah
            $table->boolean('validasi_nasabah')->default(0);
            $table->boolean('validasi_pengepul')->default(0);
            // $table->timestamp('tgl')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_nasabah')->references('id')->on('nasabahs')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_sampah')->references('id')->on('sampahs')
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
        Schema::dropIfExists('transaksi_sampahs');
    }
}
