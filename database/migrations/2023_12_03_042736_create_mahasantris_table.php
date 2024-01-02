<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasantris', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nim')->nullable();
            $table->string('nama_depan')->nullable();
            $table->string('nama_belakang')->nullable();
            $table->string('email')->nullable();
            $table->string('handphone')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('suku')->nullable();
            $table->string('saudara')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('foto')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('tempat_ayah')->nullable();
            $table->date('lahir_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('tempat_ibu')->nullable();
            $table->date('lahir_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('handphone_wali')->nullable();
            $table->string('whatsapp_wali')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->text('alamat_sekolah')->nullable();
            $table->string('nomor_ijazah')->nullable();
            $table->date('tanggal_ijazah')->nullable();
            $table->string('asal_pesantren')->nullable();
            $table->text('alamat_pesantren')->nullable();
            $table->string('hobi')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('penyakit')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('class_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasantris');
    }
};
