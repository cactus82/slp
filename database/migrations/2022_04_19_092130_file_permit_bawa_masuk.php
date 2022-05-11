<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FilePermitBawaMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fail_permit_bawa_masuk', function (Blueprint $table) {
            $table->id();
            $table->integer('borang_id')->nullable();
            $table->string('file_name')->nullable();
            $table->decimal('file_size',8,2)->nullable();
            $table->string('original_name')->nullable();
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
        Schema::dropIfExists('fail_permit_bawa_masuk');
    }
}
