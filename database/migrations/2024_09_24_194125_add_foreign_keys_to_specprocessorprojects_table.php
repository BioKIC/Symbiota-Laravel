<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('specprocessorprojects', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_specprocessorprojects_coll')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdByUid'], 'FK_specprocprojects_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('specprocessorprojects', function (Blueprint $table) {
            $table->dropForeign('FK_specprocessorprojects_coll');
            $table->dropForeign('FK_specprocprojects_uid');
        });
    }
};
