<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEwalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ewalletable_id');
            $table->string('ewalletable_type');
            $table->string('nomor');
            $table->string('qrcode');
            $table->string('nama_akun');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ewallets');
    }
}
