<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('portalpublications', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_portalpub_collid')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_portalpub_createdUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['portalID'], 'FK_portalpub_portalID')->references(['portalID'])->on('portalindex')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('portalpublications', function (Blueprint $table) {
            $table->dropForeign('FK_portalpub_collid');
            $table->dropForeign('FK_portalpub_createdUid');
            $table->dropForeign('FK_portalpub_portalID');
        });
    }
};
