<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SenaraiDibawaMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senarai_dibawa_masuk', function (Blueprint $table) {
            $table->id();
            $table->integer('borang_id')->nullable();
            $table->integer('jenis_dibawa_masuk_id')->nullable();
            $table->integer('spesis_id')->nullable();
            $table->string('bilangan')->nullable();
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
        Schema::dropIfExists('senarai_dibawa_masuk');
    }
}
