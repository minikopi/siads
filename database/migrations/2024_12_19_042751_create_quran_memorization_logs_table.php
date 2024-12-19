<?php

use App\Models\Mahasantri;
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
        Schema::create('quran_memorization_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasantri::class)->constrained();
            $table->string('mahasantri', 255);
            $table->string('nim', 255);
            $table->integer('juz_number');
            $table->integer('page_number')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_memorization_logs');
    }
};
