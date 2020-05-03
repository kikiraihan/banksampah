<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampahs', function (Blueprint $table) {
            $table->increments('id');//PK

            $table->string('nama',30);
            $table->integer('harga');
            $table->text('deskripsi',191);
            $table->integer('per_angka');
            $table->string('per_satuan',10);
            // 100          gram
            //per_angka  per_satuan

            $table->timestamps();
            // $table->softDeletes();


            $table->integer('id_pengepul')->unsigned();//FK
            $table->foreign('id_pengepul')->references('id')->on('pengepuls')
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
        Schema::dropIfExists('sampahs');
    }
}
