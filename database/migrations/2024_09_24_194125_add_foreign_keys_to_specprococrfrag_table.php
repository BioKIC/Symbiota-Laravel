<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('specprococrfrag', function (Blueprint $table) {
            $table->foreign(['prlid'], 'FK_specprococrfrag_prlid')->references(['prlid'])->on('specprocessorrawlabels')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('specprococrfrag', function (Blueprint $table) {
            $table->dropForeign('FK_specprococrfrag_prlid');
        });
    }
};
