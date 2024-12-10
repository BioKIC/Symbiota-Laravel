<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcsimages', function (Blueprint $table) {
            $table->foreign(['cid', 'cs'], 'FK_kscsimages_kscs')->references(['cid', 'cs'])->on('kmcs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcsimages', function (Blueprint $table) {
            $table->dropForeign('FK_kscsimages_kscs');
        });
    }
};
