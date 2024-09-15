<?php

use App\Models\AcademicYear;
use App\Models\Mahasantri;
use App\Models\PaymentType;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mahasantri::class)->constrained();
            $table->unsignedSmallInteger('semester');
            $table->foreignIdFor(AcademicYear::class)->constrained();
            $table->foreignIdFor(PaymentType::class)->constrained();
            $table->decimal('total', 9, 0)->default(0);
            $table->decimal('discount', 9, 0)->default(0);
            $table->decimal('paid', 9, 0)->default(0);
            $table->decimal('outstanding', 9, 0)->storedAs('total - discount - paid');
            $table->text('note')->nullable();
            $table->string('created_by')->default('System');
            $table->string('updated_by')->default('System');
            $table->timestamps();
        });

        Schema::table('payment_types', function (Blueprint $table) {
            $table->boolean('published')->default(false)->after('academic_year_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_types', function (Blueprint $table) {
            $table->dropColumn('academic_year_id');
        });
        Schema::dropIfExists('payments');
    }
};
