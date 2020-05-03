<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');//PK



            //challengge
            $table->integer('id_challengge')->unsigned();
            $table->integer('id_transaksi_sampah')->unsigned();//ambil sampah->challengge_sampah->point_didapat
            $table->integer('id_nasabah')->unsigned();//nanti hapus sja, bken has many through


            //general
            $table->timestamps();
            // isi=point_didapat*transaksi_sampah->total_satuan;
            $table->tinyInteger('isi')->default(0);//point nilai untuk ditukar//berkurang ketika ditarik
            // $table->timestamp('ekspired_date')->nullable();//sudah ada di challengge dpe expired
            //buat asesor dimana akses point dari nasabah hanya
            //yang where point->challengge->expired_date >= now()


            //set FK
            $table->foreign('id_challengge')
                ->references('id')
                ->on('challengges')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_transaksi_sampah')
                ->references('id')
                ->on('transaksi_sampahs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_nasabah')
                ->references('id')
                ->on('nasabahs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
