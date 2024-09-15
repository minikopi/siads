<?php

use App\Models\AcademicYear;
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
        Schema::table('mahasantris', function (Blueprint $table) {
            $table->foreignIdFor(AcademicYear::class)->nullable()->after('nim')->constrained();
            $table->decimal('wakaf', 9, 0)->nullable()->after('academic_year_id');
        });

        DB::statement("
            ALTER TABLE mahasantris
            ADD nama_lengkap VARCHAR(255) AS (CONCAT(nama_depan, ' ', nama_belakang)) STORED AFTER nama_belakang
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasantris', function (Blueprint $table) {
            $table->dropForeignIdFor(AcademicYear::class);
            $table->dropConstrainedForeignIdFor(AcademicYear::class);
            $table->dropColumn(['academic_year_id', 'wakaf', 'nama_lengkap']);
        });
    }
};
