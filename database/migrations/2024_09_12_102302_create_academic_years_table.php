<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->year('start_year');
            $table->year('end_year');
            $table->boolean('active')->default(false)->comment('Penanda untuk tahun ajaran aktif');
            $table->boolean('registration')->default(false)->comment('Penanda untuk tahun ajaran baru');
            $table->boolean('visible')->default(true);
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();

            $table->unique(['start_year', 'end_year']);
        });

        DB::statement("
            ALTER TABLE academic_years
            ADD full_year VARCHAR(9) AS (CONCAT(start_year, '/', end_year)) VIRTUAL AFTER end_year
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
    }
};
