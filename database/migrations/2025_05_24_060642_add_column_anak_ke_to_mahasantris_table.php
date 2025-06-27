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
        Schema::table('mahasantris', function (Blueprint $table) {
            $table->integer('anak_ke')->nullable()->after('saudara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasantris', function (Blueprint $table) {
            $table->dropColumn('anak_ke');
        });
    }
};
