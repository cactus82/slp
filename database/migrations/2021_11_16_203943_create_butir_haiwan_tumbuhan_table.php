<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButirHaiwanTumbuhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('butir_haiwan_tumbuhan', function (Blueprint $table) {
            $table->id();
            $table->integer('borang_permit_penternakan_id')->nullable();
            $table->string('spesis')->nullable();
            $table->string('bilangan_kuantiti')->nullable();
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
        Schema::dropIfExists('butir_haiwan_tumbuhan');
    }
}
