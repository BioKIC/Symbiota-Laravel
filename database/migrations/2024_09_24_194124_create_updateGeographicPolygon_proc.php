<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        DB::unprepared('CREATE PROCEDURE `updateGeographicPolygon`(IN geo_id int, IN geo_json longtext)
BEGIN
    UPDATE geographicpolygon SET geoJSON = geo_json, footprintPolygon = ST_GeomFromGeoJSON(geo_json) WHERE geoThesID = geo_id;
  END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        DB::unprepared('DROP PROCEDURE IF EXISTS updateGeographicPolygon');
    }
};
