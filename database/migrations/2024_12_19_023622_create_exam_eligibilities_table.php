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
        Schema::create('exam_eligibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasantri::class)->constrained();
            $table->integer('semester');
            $table->boolean('eligible')->default(false);
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('exam_eligibilities');
    }
};