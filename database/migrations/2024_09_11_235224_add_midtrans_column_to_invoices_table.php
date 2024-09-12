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
        Schema::table('invoices', function (Blueprint $table) {
            $table->after('payment_url', function (Blueprint $table) {
                $table->string('payment_type')->nullable();
                $table->string('merchant_name')->nullable();
                $table->string('merchant_number')->nullable();
                $table->string('transaction_status')->nullable();
                $table->string('fraud_status')->nullable();
                $table->decimal('merchant_amount', places: 0)->default(0);
                $table->decimal('nett_amount', places: 0)->storedAs('total - merchant_amount');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'payment_type',
                'merchant_name',
                'merchant_number',
                'transaction_status',
                'fraud_status',
                'merchant_amount',
                'nett_amount'
            ]);
        });
    }
};
