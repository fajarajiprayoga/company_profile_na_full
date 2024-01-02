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
            $table->boolean('show_in_home')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('lighting_images');
            $table->dropColumn('couches_images');
            $table->dropColumn('interior_images');
            $table->dropColumn('exterior_images');
            $table->dropColumn('driver_station_images');
            $table->dropColumn('wallpaper');
            $table->dropColumn('show_in_home');
        });
    }
};
