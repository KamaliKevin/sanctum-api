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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->unsignedSmallInteger('weekly_hours');
            $table->enum('shift_time', ['Mañana', 'Tarde']);
            $table->unsignedSmallInteger('classroom');
            $table->unsignedBigInteger('user_id')->nullable()->constrained();
            $table->unsignedBigInteger('specialty_id')->nullable()->constrained();
            $table->unsignedBigInteger('department_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
