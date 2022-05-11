<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResitAmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resit_am', function (Blueprint $table) {
            $table->id();
            $table->string('no_resit')->nullable();
            $table->date('tarikh_resit')->nullable();
            $table->decimal('jumlah_rm',8,2)->nullable();
            $table->integer('pejabat_pembayaran_id')->nullable();
            $table->string('no_lesen')->nullable();
            $table->integer('permit_type_id')->nullable();
            $table->integer('permit_id')->nullable();
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
        Schema::dropIfExists('resit_am');
    }
}
