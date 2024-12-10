<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccuredits', function (Blueprint $table) {
            $table->foreign(['occid'], 'fk_omoccuredits_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid'], 'fk_omoccuredits_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccuredits', function (Blueprint $table) {
            $table->dropForeign('fk_omoccuredits_occid');
            $table->dropForeign('fk_omoccuredits_uid');
        });
    }
};
