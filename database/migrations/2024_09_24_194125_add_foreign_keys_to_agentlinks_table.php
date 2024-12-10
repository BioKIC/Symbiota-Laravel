<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentlinks', function (Blueprint $table) {
            $table->foreign(['agentID'], 'FK_agentlinks_agentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_agentlinks_createdUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['modifiedUid'], 'FK_agentlinks_modUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentlinks', function (Blueprint $table) {
            $table->dropForeign('FK_agentlinks_agentID');
            $table->dropForeign('FK_agentlinks_createdUid');
            $table->dropForeign('FK_agentlinks_modUid');
        });
    }
};
