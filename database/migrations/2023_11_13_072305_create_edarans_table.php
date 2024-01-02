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
        Schema::create('edarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('no')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('status')->nullable();
            $table->text('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edarans');
    }
};
