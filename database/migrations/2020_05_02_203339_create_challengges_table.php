<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallenggesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challengges', function (Blueprint $table) {
            $table->increments('id');

            $table->string('judul',30);


            $table->timestamp('ekspired_date')->nullable();
            $table->timestamps();

            $table->integer('id_challengger')->unsigned();
            $table->foreign('id_challengger')
                ->references('id')
                ->on('challenggers')
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
        Schema::dropIfExists('challengges');
    }
}
