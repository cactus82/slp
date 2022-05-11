<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BorangPermitBawaMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_permit_bawa_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_kp')->nullable();
            $table->string('no_tel_hp')->nullable();
            $table->string('tujuan_dibawa_masuk')->nullable();
            $table->integer('negara_asal_id')->nullable();
            $table->integer('medium_penghantaran_id')->nullable();
            $table->string('medium_penghantaran_remark')->nullable();
            $table->integer('jenis_dibawa_masuk_id')->nullable();
            //list table for jenis barang
            //columns: id, jenis_barang, spesis, bilangan tiap jantina
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
        Schema::dropIfExists('borang_permit_bawa_masuk');
    }
}
