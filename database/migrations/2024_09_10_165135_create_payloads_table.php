<?php

use App\Models\User;
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
        Schema::create('payloads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->string('payload_type')->default('request');
            $table->text('payload');
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('snap_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payloads');
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('expired_at');
        });
    }
};
