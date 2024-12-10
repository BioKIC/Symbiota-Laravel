<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurpaleogts', function (Blueprint $table) {
            $table->foreign(['parentgtsid'], 'FK_gtsparent')->references(['gtsid'])->on('omoccurpaleogts')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurpaleogts', function (Blueprint $table) {
            $table->dropForeign('FK_gtsparent');
        });
    }
};
