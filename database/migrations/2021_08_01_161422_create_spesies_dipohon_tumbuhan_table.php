<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesiesDipohonTumbuhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesies_dipohon_tumbuhan', function (Blueprint $table) {
            $table->id();
            $table->integer('borang_id')->nullable();
            $table->string('spesies')->nullable();
            $table->integer('bilangan')->nullable();
            $table->string('kawasan')->nullable();
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
        Schema::dropIfExists('spesies_dipohon_tumbuhan');
    }
}
