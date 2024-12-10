<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        DB::unprepared('CREATE PROCEDURE `insertGeographicPolygon`(IN geo_id int, IN geo_json longtext)
BEGIN
    INSERT INTO geographicpolygon (geoThesID, footprintPolygon, geoJSON) VALUES (geo_id, ST_GeomFromGeoJSON(geo_json), geo_json);
  END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        DB::unprepared('DROP PROCEDURE IF EXISTS insertGeographicPolygon');
    }
};
