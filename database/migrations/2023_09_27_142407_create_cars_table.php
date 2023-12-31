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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_image')->nullable();
            $table->string('description')->nullable();
            $table->integer('seating_capacity')->nullable();
            $table->decimal('rent_per_day', 10, 2)->nullable();
            $table->boolean('is_booked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
