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
        Schema::table('payment_types', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('academic_year_id');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->date('due_date')->nullable()->after('installment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_types', function (Blueprint $table) {
            $table->dropColumn('due_date');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('due_date');
        });
    }
};
