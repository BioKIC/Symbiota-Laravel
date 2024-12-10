<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referencechklsttaxalink', function (Blueprint $table) {
            $table->foreign(['clid', 'tid'], 'FK_refchktaxalink_clidtid')->references(['clid', 'tid'])->on('fmchklsttaxalink')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['refid'], 'FK_refchktaxalink_ref')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referencechklsttaxalink', function (Blueprint $table) {
            $table->dropForeign('FK_refchktaxalink_clidtid');
            $table->dropForeign('FK_refchktaxalink_ref');
        });
    }
};
