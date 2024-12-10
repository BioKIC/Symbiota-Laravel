<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('igsnverification', function (Blueprint $table) {
            $table->foreign(['occidInPortal'], 'FK_igsn_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('igsnverification', function (Blueprint $table) {
            $table->dropForeign('FK_igsn_occid');
        });
    }
};
