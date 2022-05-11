<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorangLesenTumbuhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_lesen_tumbuhan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_lesen')->nullable();
            $table->integer('daerah_memungut_id')->nullable();
            $table->integer('pejabat_lesen_id')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('no_kp')->nullable();
            $table->string('no_tel_rumah')->nullable();
            $table->string('no_tel_hp')->nullable();
            $table->string('penduduk_sabah')->nullable();
            $table->string('alamat_kediaman')->nullable();
            $table->string('nama_penuh_pemungut')->nullable();
            $table->string('no_kp_pemungut')->nullable();
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
            $table->string('nombor_lesen')->nullable();
            $table->integer('renewal')->string();
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
        Schema::dropIfExists('borang_lesen_tumbuhan');
    }
}
