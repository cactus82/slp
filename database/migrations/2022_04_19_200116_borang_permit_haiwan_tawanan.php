<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BorangPermitHaiwanTawanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_permit_haiwan_tawanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('no_tel_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('butir_permit_tawanan_lain')->nullable();
            $table->string('butir_ringkas_pengaturan')->nullable();
            $table->string('butir_ringkas_diet')->nullable();
            //create salinan_sijil_kesihatan table
            //create senarai_spesis_tawanan table. spesis columns: id, spesis, bilangan
            $table->dateTime('tarikh_permohonan')->nullable();
            $table->integer('status_borang_id')->nullable();
            $table->integer('keputusan_ujian_id')->nullable();
            $table->string('ulasan_jhl')->nullable();
            $table->date('tarikh_ulasan_dipohon')->nullable();
            $table->date('tarikh_ulasan_diterima')->nullable();
            $table->integer('kaedah_ulasan_id')->nullable();
            $table->string('komen')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('dikembalikan_oleh')->nullable();
            $table->string('sebab_dikembalikan')->nullable();
            $table->dateTime('tarikh_dikembalikan')->nullable();
            $table->integer('disahkan_oleh')->nullable();
            $table->dateTime('tarikh_disahkan')->nullable();
            $table->integer('diluluskan_oleh')->nullable();
            $table->dateTime('tarikh_diluluskan')->nullable();
            $table->integer('ditolak_oleh')->nullable();
            $table->dateTime('tarikh_ditolak')->nullable();
            $table->integer('resit_am_id')->nullable();
            $table->integer('permit_file_id')->nullable();
            $table->string('nombor_permit')->nullable();
            $table->integer('renewal')->nullable();
            $table->dateTime('tarikh_berkuatkuasa')->nullable();
            $table->dateTime('tarikh_tamat_tempoh')->nullable();
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
        Schema::dropIfExists('borang_permit_haiwan_tawanan');
    }
}
