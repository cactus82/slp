<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHidupanLiarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hidupan_liar', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('NAMA_TEMPATAN')->nullable();
            $table->string('NAMA_SAINTIFIK')->nullable();
            $table->integer('JENIS_HL_ID')->nullable();
            $table->integer('KUMPULAN_HL_ID')->nullable();
            $table->integer('JADUAL_PERLINDUNGAN_ID')->nullable();
            $table->integer('STATUS_IUCN_ID')->nullable();
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
        Schema::dropIfExists('hidupan_liar');
    }
}
