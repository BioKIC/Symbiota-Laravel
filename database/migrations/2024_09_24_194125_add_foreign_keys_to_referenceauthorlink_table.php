<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referenceauthorlink', function (Blueprint $table) {
            $table->foreign(['refauthid'], 'FK_refauthlink_refauthid')->references(['refauthorid'])->on('referenceauthors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['refid'], 'FK_refauthlink_refid')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referenceauthorlink', function (Blueprint $table) {
            $table->dropForeign('FK_refauthlink_refauthid');
            $table->dropForeign('FK_refauthlink_refid');
        });
    }
};
