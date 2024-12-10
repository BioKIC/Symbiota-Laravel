<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossarycategorylink', function (Blueprint $table) {
            $table->integer('glossCatLinkID', true);
            $table->unsignedInteger('glossID')->index('fk_glosscatlink_glossid_idx');
            $table->integer('glossCatID')->index('fk_glosscatlink_glosscatid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossarycategorylink');
    }
};
