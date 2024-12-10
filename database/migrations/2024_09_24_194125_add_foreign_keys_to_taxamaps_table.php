<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxamaps', function (Blueprint $table) {
            $table->foreign(['tid'], 'FK_taxamaps_taxa')->references(['tid'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxamaps', function (Blueprint $table) {
            $table->dropForeign('FK_taxamaps_taxa');
        });
    }
};
