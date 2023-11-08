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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->foreignId('plant_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float('quantity_planty');
            $table->float('expected_productivity');
            $table->timestamp('start_day');
            $table->timestamp('end_day');
            $table->string("4season");
            $table->float('productivity')->default(0.0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
