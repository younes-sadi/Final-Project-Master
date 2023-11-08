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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->unique()->constrained()->onDelete('cascade')->onUpdate("cascade");
            $table->float('TemperatureValeur_max');
            $table->float('TemperatureValeur_min');
            $table->float('HumidityValeur');
            $table->float('SoilValeur');
            $table->float('LightValeur_max');
            $table->float('LightValeur_min');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
