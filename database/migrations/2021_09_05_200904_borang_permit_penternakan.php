<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BorangPermitPenternakan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_permit_penternakan', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by')->nullable();
            $table->string('jenis_permit')->nullable();
            $table->string('nama_penuh')->nullable();
            $table->string('no_kp')->nullable();
            $table->string('no_tel')->nullable();
            $table->string('alamat_kediaman')->nullable();
            $table->string('butir_lesen_permit')->nullable();
            $table->string('alamat_penternakan_penanaman')->nullable();
            $table->string('saiz_kawasan')->nullable();
            $table->string('deskripsi_bangunan')->nullable();
            $table->string('butir_peraturan')->nullable();
            $table->string('butir_stok')->nullable();
            $table->string('butir_diet')->nullable();
            $table->string('salinan_ramalan')->nullable();
            $table->integer('status_borang_id')->nullable();
            $table->integer('resit_am_id')->nullable();
            $table->integer('permit_file_id')->nullable();
            $table->string('nombor_permit')->nullable();
            $table->date('tarikh_berkuatkuasa')->nullable();
            $table->date('tarikh_tamat_tempoh')->nullable();
            $table->integer('disahkan_oleh')->nullable();
            $table->date('tarikh_disahkan')->nullable();
            $table->integer('diluluskan_oleh')->nullable();
            $table->date('tarikh_diluluskan')->nullable();
            $table->integer('ditolak_oleh')->nullable();
            $table->date('tarikh_ditolak')->nullable();
            $table->integer('renewal')->nullable();
            $table->integer('dikembalikan_oleh')->nullable();
            $table->string('sebab_dikembalikan')->nullable();
            $table->dateTime('tarikh_dikembalikan')->nullable();
            $table->integer('tempoh_permit_lesen')->nullable();
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
        Schema::dropIfExists('borang_permit_penternakan');
    }
}
