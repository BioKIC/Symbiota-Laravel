<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('uploadspecmap', function (Blueprint $table) {
            $table->foreign(['uspid'], 'FK_uploadspecmap_usp')->references(['uspid'])->on('uploadspecparameters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('uploadspecmap', function (Blueprint $table) {
            $table->dropForeign('FK_uploadspecmap_usp');
        });
    }
};
