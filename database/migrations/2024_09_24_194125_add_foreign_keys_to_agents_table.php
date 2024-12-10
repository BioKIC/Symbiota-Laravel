<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agents', function (Blueprint $table) {
            $table->foreign(['createdUid'], 'FK_agents_createdUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['modifiedUid'], 'FK_agents_modUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['preferredRecByID'], 'FK_agents_preferred_recby')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropForeign('FK_agents_createdUid');
            $table->dropForeign('FK_agents_modUid');
            $table->dropForeign('FK_agents_preferred_recby');
        });
    }
};
