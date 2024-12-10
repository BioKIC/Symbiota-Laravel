<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referencetaxalink', function (Blueprint $table) {
            $table->foreign(['refid'], 'FK_reftaxalink_refid')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_reftaxalink_tid')->references(['TID'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referencetaxalink', function (Blueprint $table) {
            $table->dropForeign('FK_reftaxalink_refid');
            $table->dropForeign('FK_reftaxalink_tid');
        });
    }
};
