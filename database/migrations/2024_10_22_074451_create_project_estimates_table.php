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
        Schema::create('project_estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('project_id')->unique();
            $table->text('project_name');
            $table->date('contractual_start_date');
            $table->date('contractual_end_date');
            $table->date('actual_start_date');
            $table->date('actual_end_date');
            $table->text('project_type');
            $table->enum('project_status',['pending', 'in_progress', 'completed', 'canceled'])->default('pending');
            $table->longText('description');
            $table->longText('areeb_custom_note');
            $table->double('general_cost');
            $table->double('profit_precentage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_estimates');
    }
};
