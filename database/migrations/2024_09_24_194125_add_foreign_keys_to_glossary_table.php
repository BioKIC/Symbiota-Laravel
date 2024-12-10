<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('glossary', function (Blueprint $table) {
            $table->foreign(['uid'], 'FK_glossary_uid')->references(['uid'])->on('users')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('glossary', function (Blueprint $table) {
            $table->dropForeign('FK_glossary_uid');
        });
    }
};
