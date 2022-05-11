<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSenaraiKawasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senarai_kawasan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kawasan')->nullable();
            $table->tinyInteger('memburu_dibenarkan')->nullable();
            $table->tinyInteger('memungut_dibenarkan')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('senarai_kawasan');
    }
}
