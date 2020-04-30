<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');//PK

            $table->string('nama',30)->unique();
            $table->integer('point');
            $table->integer('stock');
            $table->string('foto',191)->nullable();
            $table->boolean('validasi')->default(0);

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
        Schema::dropIfExists('rewards');
    }
}
