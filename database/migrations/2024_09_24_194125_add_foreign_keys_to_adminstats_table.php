<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('adminstats', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_adminstats_collid')->references(['CollID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid'], 'FK_adminstats_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('adminstats', function (Blueprint $table) {
            $table->dropForeign('FK_adminstats_collid');
            $table->dropForeign('FK_adminstats_uid');
        });
    }
};
