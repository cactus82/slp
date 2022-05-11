<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorangLesenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borang_lesen', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_lesen')->nullable();
            $table->string('kawasan_memburu')->nullable();
            $table->date('tarikh_mula_memburu')->nullable();
            $table->date('tarikh_tamat_memburu')->nullable();
            $table->integer('daerah_memburu_id')->nullable();
            $table->integer('pejabat_lesen_id')->nullable();
            $table->string('kawasan_ditangkap')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('no_kp')->nullable();
            $table->string('no_tel_rumah')->nullable();
            $table->string('no_tel_hp')->nullable();
            $table->string('no_pendaftaran_kereta')->nullable();
            $table->string('penduduk_sabah')->nullable();
            $table->string('alamat_kediaman')->nullable();
            $table->string('nama_teman_1')->nullable();
            $table->string('no_kp_teman_1')->nullable();
            $table->string('no_lesen_senjata_teman1')->nullable();
            $table->string('nama_teman_2')->nullable();
            $table->string('no_kp_teman_2')->nullable();
            $table->string('no_lesen_senjata_teman2')->nullable();
            $table->string('nama_teman_3')->nullable();
            $table->string('no_kp_teman_3')->nullable();
            $table->string('no_lesen_senjata_teman3')->nullable();
            $table->string('nama_teman_4')->nullable();
            $table->string('no_kp_teman_4')->nullable();
            $table->string('no_lesen_senjata_teman4')->nullable();
            $table->string('buatan_senjata_api')->nullable();
            $table->string('ukuran_garis_pusat')->nullable();
            $table->string('serial_senjata_api')->nullable();
            $table->string('no_lesen_senjata_api')->nullable();
            $table->date('tarikh_pengeluaran_senjata_api')->nullable();
            $table->string('tempat_pengeluaran_senjata_api')->nullable();
            $table->string('syarat_lesen_senjata_api')->nullable();
            $table->date('tarikh_permohonan')->nullable();
            $table->date('tarikh_diperiksa')->nullable();
            $table->integer('diperiksa_oleh_id')->nullable();
            $table->string('ulasan_pemeriksa')->nullable();
            $table->dateTime('tarikh_disemak_kaw_memburu')->nullable();
            $table->integer('disemak_oleh_id')->nullable();
            $table->dateTime('tarikh_ephl_dinilai')->nullable();
            $table->integer('dinilai_oleh_id')->nullable();
            $table->dateTime('tarikh_bil_haiwan_tempoh_memburu')->nullable();
            $table->integer('diperiksa_bil_haiwan_tempoh_id')->nullable();
            $table->string('status_kelulusan')->nullable();
            $table->integer('diluluskan_id')->nullable();
            $table->integer('soalan_ephl_id')->nullable();
            $table->string('jawapan_soalan_ephl')->nullable();
            $table->integer('status_borang_id')->nullable();
            $table->string('return_remark')->nullable();
            $table->string('keputusan_ujian_id')->nullable();
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
        Schema::dropIfExists('borang_lesen');
    }
}
