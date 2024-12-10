<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentnames', function (Blueprint $table) {
            $table->foreign(['agentID'], 'FK_agentnames_agentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentnames', function (Blueprint $table) {
            $table->dropForeign('FK_agentnames_agentID');
        });
    }
};
