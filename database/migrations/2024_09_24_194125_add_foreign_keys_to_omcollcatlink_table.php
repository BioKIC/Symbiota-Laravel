<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omcollcatlink', function (Blueprint $table) {
            $table->foreign(['ccpk'], 'FK_collcatlink_cat')->references(['ccpk'])->on('omcollcategories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['collid'], 'FK_collcatlink_coll')->references(['CollID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omcollcatlink', function (Blueprint $table) {
            $table->dropForeign('FK_collcatlink_cat');
            $table->dropForeign('FK_collcatlink_coll');
        });
    }
};
