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
        Schema::create('highlight_venue', function (Blueprint $table) {
            $table->foreignId('venue_id')->constrained()->cascadeOnDelete();
            $table->foreignId('highlight_id')->constrained()->cascadeOnDelete();

            $table->boolean('is_primary')->default(false); 

            $table->primary(['venue_id','highlight_id']);
            
            $table->index(['highlight_id','venue_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues_highlights');
    }
};
