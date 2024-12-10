<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('uploadspecparameters', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_uploadspecparameters_coll')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_uploadspecparameters_uid')->references(['uid'])->on('users')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('uploadspecparameters', function (Blueprint $table) {
            $table->dropForeign('FK_uploadspecparameters_coll');
            $table->dropForeign('FK_uploadspecparameters_uid');
        });
    }
};
