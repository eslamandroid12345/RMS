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
        Schema::create('time_sheet_gaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_sheet_id')->nullable()->constrained('time_sheets')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('from');
            $table->timestamp('to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_sheet_gaps');
    }
};
