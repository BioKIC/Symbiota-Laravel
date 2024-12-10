<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omcrowdsourcequeue', function (Blueprint $table) {
            $table->foreign(['csProjID'], 'FK_omcrowdsourcequeue_csProjID')->references(['csProjID'])->on('omcrowdsourceproject')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['occid'], 'FK_omcrowdsourcequeue_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uidprocessor'], 'FK_omcrowdsourcequeue_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omcrowdsourcequeue', function (Blueprint $table) {
            $table->dropForeign('FK_omcrowdsourcequeue_csProjID');
            $table->dropForeign('FK_omcrowdsourcequeue_occid');
            $table->dropForeign('FK_omcrowdsourcequeue_uid');
        });
    }
};
