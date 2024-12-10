<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('imageprojects', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_imageproject_collid')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uidcreated'], 'FK_imageproject_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('imageprojects', function (Blueprint $table) {
            $table->dropForeign('FK_imageproject_collid');
            $table->dropForeign('FK_imageproject_uid');
        });
    }
};
