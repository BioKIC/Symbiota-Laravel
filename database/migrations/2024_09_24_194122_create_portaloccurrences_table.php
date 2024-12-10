<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('portaloccurrences', function (Blueprint $table) {
            $table->increments('portalOccurrencesID');
            $table->unsignedInteger('occid')->index('fk_portaloccur_occid_idx');
            $table->unsignedInteger('pubid')->index('fk_portaloccur_pubid_idx');
            $table->integer('remoteOccid')->nullable();
            $table->integer('verification')->default(0);
            $table->dateTime('refreshTimestamp');
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['occid', 'pubid'], 'uq_portaloccur_occid_pubid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('portaloccurrences');
    }
};
