<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxaprofilepubmaplink', function (Blueprint $table) {
            $table->foreign(['tppid'], 'FK_tppubmaplink_id')->references(['tppid'])->on('taxaprofilepubs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['mid'], 'FK_tppubmaplink_tdbid')->references(['mid'])->on('taxamaps')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxaprofilepubmaplink', function (Blueprint $table) {
            $table->dropForeign('FK_tppubmaplink_id');
            $table->dropForeign('FK_tppubmaplink_tdbid');
        });
    }
};
