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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('entity_id');
            $table->enum('actual_status', ['Operationaly','Faulty','Repair'])->default('Operationaly');
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
