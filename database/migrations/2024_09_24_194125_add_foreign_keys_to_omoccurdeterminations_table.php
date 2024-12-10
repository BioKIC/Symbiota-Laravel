<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurdeterminations', function (Blueprint $table) {
            $table->foreign(['identifiedByAgentID'], 'FK_omoccurdets_agentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['occid'], 'FK_omoccurdets_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tidInterpreted'], 'FK_omoccurdets_tid')->references(['TID'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['enteredByUid'], 'FK_omoccurdets_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurdeterminations', function (Blueprint $table) {
            $table->dropForeign('FK_omoccurdets_agentID');
            $table->dropForeign('FK_omoccurdets_occid');
            $table->dropForeign('FK_omoccurdets_tid');
            $table->dropForeign('FK_omoccurdets_uid');
        });
    }
};
