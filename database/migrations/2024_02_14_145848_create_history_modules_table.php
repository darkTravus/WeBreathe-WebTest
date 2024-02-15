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
        Schema::create('history_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->float('temperature_value')->nullable();
            $table->float('total_passenger_count')->nullable();
            $table->float('distance_traveled')->nullable();
            $table->float('boarding_passenger_count')->nullable();
            $table->float('alighting_passenger_count')->nullable();
            $table->timestamps();
        
            // Foreign key
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_modules');
    }
};
