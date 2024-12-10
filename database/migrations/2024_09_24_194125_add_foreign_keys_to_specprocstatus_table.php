<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('specprocstatus', function (Blueprint $table) {
            $table->foreign(['occid'], 'specprocstatus_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['processorUid'], 'specprocstatus_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('specprocstatus', function (Blueprint $table) {
            $table->dropForeign('specprocstatus_occid');
            $table->dropForeign('specprocstatus_uid');
        });
    }
};
