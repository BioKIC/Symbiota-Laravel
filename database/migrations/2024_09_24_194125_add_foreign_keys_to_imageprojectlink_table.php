<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('imageprojectlink', function (Blueprint $table) {
            $table->foreign(['imgid'], 'FK_imageprojectlink_imgid')->references(['imgid'])->on('images')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['imgprojid'], 'FK_imageprojlink_imgprojid')->references(['imgprojid'])->on('imageprojects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('imageprojectlink', function (Blueprint $table) {
            $table->dropForeign('FK_imageprojectlink_imgid');
            $table->dropForeign('FK_imageprojlink_imgprojid');
        });
    }
};
