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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id')->nullable();
            $table->integer('schedule_id')->nullable();
            $table->integer('total_pelajaran')->nullable();
            $table->integer('persentasi_kehadiran')->nullable();
            $table->float('akademik')->nullable();
            $table->float('non_akademik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
