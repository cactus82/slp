<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButiranSenjataApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('butiran_senjata_api', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('no_lesen_senjata_api')->nullable();
            $table->date('tarikh_pengeluaran')->nullable();
            $table->string('tempat_pengeluaran')->nullable();
            $table->string('buatan')->nullable();
            $table->string('ukuran_garis_pusat')->nullable();
            $table->string('no_serial')->nullable();
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
        Schema::dropIfExists('butiran_senjata_api');
    }
}
