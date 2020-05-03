<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChallenggeSampah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challengge_sampah', function (Blueprint $table) {
            $table->integer('id_challengge')->unsigned()->index();
            $table->integer('id_sampah')->unsigned()->index();
            $table->integer('point_didapat');
            $table->timestamps();

            //set PK
            $table->primary(['id_challengge','id_sampah']);

            //set FK
            $table->foreign('id_challengge')
                ->references('id')
                ->on('challengges')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_sampah')
                ->references('id')
                ->on('sampahs')
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
        //
    }
}
