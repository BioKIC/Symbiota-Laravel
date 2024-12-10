<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omexsiccatinumbers', function (Blueprint $table) {
            $table->foreign(['ometid'], 'FK_exsiccatiTitleNumber')->references(['ometid'])->on('omexsiccatititles')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omexsiccatinumbers', function (Blueprint $table) {
            $table->dropForeign('FK_exsiccatiTitleNumber');
        });
    }
};
