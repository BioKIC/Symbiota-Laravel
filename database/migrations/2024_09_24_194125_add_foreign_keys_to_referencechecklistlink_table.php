<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referencechecklistlink', function (Blueprint $table) {
            $table->foreign(['clid'], 'FK_refchecklistlink_clid')->references(['clid'])->on('fmchecklists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['refid'], 'FK_refchecklistlink_refid')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referencechecklistlink', function (Blueprint $table) {
            $table->dropForeign('FK_refchecklistlink_clid');
            $table->dropForeign('FK_refchecklistlink_refid');
        });
    }
};
