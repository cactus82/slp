<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SenaraiSpesisTawanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senarai_spesis_tawanan', function (Blueprint $table) {
            $table->id();
            $table->integer('borang_id')->nullable();
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
        Schema::dropIfExists('senarai_spesis_tawanan');
    }
}
