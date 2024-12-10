<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referencecollectionlink', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_refcollectionlink_collid')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['refid'], 'FK_refcollectionlink_refid')->references(['refid'])->on('referenceobject')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referencecollectionlink', function (Blueprint $table) {
            $table->dropForeign('FK_refcollectionlink_collid');
            $table->dropForeign('FK_refcollectionlink_refid');
        });
    }
};
