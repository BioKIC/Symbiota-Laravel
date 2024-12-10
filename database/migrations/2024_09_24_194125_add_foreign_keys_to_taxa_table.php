<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxa', function (Blueprint $table) {
            $table->foreign(['modifiedUid'], 'FK_taxa_uid')->references(['uid'])->on('users')->onUpdate('restrict')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxa', function (Blueprint $table) {
            $table->dropForeign('FK_taxa_uid');
        });
    }
};
