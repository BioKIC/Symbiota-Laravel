<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('userroles', function (Blueprint $table) {
            $table->foreign(['uid'], 'FK_userrole_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uidAssignedBy'], 'FK_userrole_uid_assigned')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('userroles', function (Blueprint $table) {
            $table->dropForeign('FK_userrole_uid');
            $table->dropForeign('FK_userrole_uid_assigned');
        });
    }
};
