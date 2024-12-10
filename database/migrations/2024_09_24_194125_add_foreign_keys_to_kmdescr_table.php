<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmdescr', function (Blueprint $table) {
            $table->foreign(['CID', 'CS'], 'FK_descr_cs')->references(['cid', 'cs'])->on('kmcs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['TID'], 'FK_descr_tid')->references(['TID'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmdescr', function (Blueprint $table) {
            $table->dropForeign('FK_descr_cs');
            $table->dropForeign('FK_descr_tid');
        });
    }
};
