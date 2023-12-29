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
        Schema::table('products', function (Blueprint $table) {
            $table->string('lighting_images')->nullable();
            $table->string('couches_images')->nullable();
            $table->string('interior_images')->nullable();
            $table->string('exterior_images')->nullable();
            $table->string('driver_station_images')->nullable();
            $table->string('wallpaper')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
