<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaerahMemburuMemungutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()//Create seeder to populate table
    {
        Schema::create('daerah_memburu_memungut', function (Blueprint $table) {
            $table->id();
            $table->string('daerah');
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
        Schema::dropIfExists('daerah_memburu_memungut');
    }
}
