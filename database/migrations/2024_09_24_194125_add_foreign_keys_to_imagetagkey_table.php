<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('imagetagkey', function (Blueprint $table) {
            $table->foreign(['imgTagGroupID'], 'FK_imageTagKey_imgTagGroupID')->references(['imgTagGroupID'])->on('imagetaggroup')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('imagetagkey', function (Blueprint $table) {
            $table->dropForeign('FK_imageTagKey_imgTagGroupID');
        });
    }
};
