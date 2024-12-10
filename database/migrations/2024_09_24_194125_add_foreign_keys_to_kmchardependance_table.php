<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmchardependance', function (Blueprint $table) {
            $table->foreign(['CID'], 'FK_chardependance_cid')->references(['cid'])->on('kmcharacters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['CIDDependance', 'CSDependance'], 'FK_chardependance_cs')->references(['cid', 'cs'])->on('kmcs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmchardependance', function (Blueprint $table) {
            $table->dropForeign('FK_chardependance_cid');
            $table->dropForeign('FK_chardependance_cs');
        });
    }
};
