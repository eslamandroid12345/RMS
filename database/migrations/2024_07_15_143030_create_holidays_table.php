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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('holidays')
                ->cascadeOnUpdate()->nullOnDelete(); // the id of the holiday which it is response to
            $table->longText("text");
            $table->enum('type' , ['DAY','PERMISSION' , 'REMOTE','OTHER'])->nullable();//null if it is response
            $table->enum('status' , ['PENDING','APPROVED' , 'REJECTED'])->nullable();//null if it is response
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
