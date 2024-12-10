<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmchecklists', function (Blueprint $table) {
            $table->foreign(['uid'], 'FK_checklists_uid')->references(['uid'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmchecklists', function (Blueprint $table) {
            $table->dropForeign('FK_checklists_uid');
        });
    }
};
