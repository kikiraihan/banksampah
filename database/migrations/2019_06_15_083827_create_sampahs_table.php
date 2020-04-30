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
            $table->integer('point');
            $table->text('deskripsi',191);
            $table->string('satuan',10);

            $table->timestamps();
            // $table->softDeletes();


            $table->integer('id_member')->unsigned();//FK
            $table->foreign('id_member')->references('id')->on('members')
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
