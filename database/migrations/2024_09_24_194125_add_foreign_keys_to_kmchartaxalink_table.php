<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmchartaxalink', function (Blueprint $table) {
            $table->foreign(['CID'], 'FK_chartaxalink_cid')->references(['cid'])->on('kmcharacters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['TID'], 'FK_chartaxalink_tid')->references(['TID'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmchartaxalink', function (Blueprint $table) {
            $table->dropForeign('FK_chartaxalink_cid');
            $table->dropForeign('FK_chartaxalink_tid');
        });
    }
};
