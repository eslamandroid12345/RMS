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
        Schema::table('report_reviews', function (Blueprint $table) {
            $table->foreignId('reciver_id')->after('author_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_reviews', function (Blueprint $table) {
            $table->dropConstrainedForeignId('reciver_id');
        });
    }
};
