<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('geographicpolygon', function (Blueprint $table) {
            $table->integer('geoThesID')->primary();
            $table->geometry('footprintPolygon');
            $table->longText('footprintWKT')->nullable();
            $table->longText('geoJSON')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->spatialIndex(['footprintPolygon'], 'ix_geopoly_polygon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('geographicpolygon');
    }
};
