<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmdyncltaxalink', function (Blueprint $table) {
            $table->foreign(['dynclid'], 'FK_dyncltaxalink_dynclid')->references(['dynclid'])->on('fmdynamicchecklists')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_dyncltaxalink_taxa')->references(['TID'])->on('taxa')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmdyncltaxalink', function (Blueprint $table) {
            $table->dropForeign('FK_dyncltaxalink_dynclid');
            $table->dropForeign('FK_dyncltaxalink_taxa');
        });
    }
};
