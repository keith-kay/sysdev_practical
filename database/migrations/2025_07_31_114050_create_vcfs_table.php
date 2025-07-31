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
        Schema::create('vcftable', function (Blueprint $table) {
            $table->id();
            $table->decimal('density', 6, 2); 
            $table->decimal('temperature', 5, 2); 
            $table->decimal('vcf', 8, 6); 
            $table->decimal('class', 5, 2)->nullable(); 
            $table->decimal('vcf2', 8, 6)->nullable();
            $table->timestamps();

            $table->unique(['density', 'temperature']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vcftable');
    }
};
