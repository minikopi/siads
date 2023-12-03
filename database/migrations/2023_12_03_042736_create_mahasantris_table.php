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
            $table->string('user_id');
            $table->string('nim');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('email');
            $table->string('handphone');
            $table->string('nik');
            $table->text('alamat');
            $table->string('kode_pos');
            $table->date('tanggal_lahir');
            $table->string('suku');
            $table->string('saudara');
            $table->string('whatsapp');
            $table->text('foto');
            $table->string('nama_ayah');
            $table->string('tempat_ayah');
            $table->date('lahir_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->bigInteger('penghasilan_ayah');
            $table->string('nama_ibu');
            $table->string('tempat_ibu');
            $table->date('lahir_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->bigInteger('penghasilan_ibu');
            $table->string('nama_wali');
            $table->text('alamat_wali');
            $table->string('handphone_wali');
            $table->string('whatsapp_wali');
            $table->string('asal_sekolah');
            $table->text('alamat_sekolah');
            $table->string('nomor_ijazah');
            $table->date('tanggal_ijazah');
            $table->string('asal_pesantren');
            $table->text('alamat_pesantren');
            $table->string('hobi');
            $table->string('golongan_darah');
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->string('penyakit');
            $table->string('jenis_kelamin');
            $table->string('status');
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
