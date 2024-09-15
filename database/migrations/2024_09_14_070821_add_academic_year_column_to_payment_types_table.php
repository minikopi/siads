<?php

use App\Models\AcademicYear;
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
        Schema::table('payment_types', function (Blueprint $table) {
            $table->after('nominal', function (Blueprint $table) {
                $table->foreignIdFor(AcademicYear::class)->nullable()->constrained();
                $table->string('created_by')->default('System');
                $table->string('updated_by')->default('System');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_types', function (Blueprint $table) {
            $table->dropForeignIdFor(AcademicYear::class);
            $table->dropColumn(['academic_year_id', 'created_by', 'updated_by']);
        });
    }
};
