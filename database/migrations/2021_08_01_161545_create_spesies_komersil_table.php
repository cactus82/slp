<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesiesKomersilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spesies_komersil', function (Blueprint $table) {
            $table->id();
            $table->integer('borang_id')->nullable();
            $table->string('spesies')->nullable();
            $table->string('bilangan_angka_perkataan')->nullable();
            $table->string('cara_tangkapan')->nullable();
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
        Schema::dropIfExists('spesies_komersil');
    }
}
