<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('time_sheets')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('from')->nullable();
            $table->timestamp('to')->nullable();
            $table->tinyInteger('activity')->nullable();
            $table->tinyInteger('idle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_sheets');
    }
};
