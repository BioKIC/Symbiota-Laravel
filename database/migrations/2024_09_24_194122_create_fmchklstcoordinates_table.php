<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmchklstcoordinates', function (Blueprint $table) {
            $table->integer('clCoordID', true);
            $table->unsignedInteger('clid')->index('ix_checklistcoord_clid');
            $table->unsignedInteger('tid')->index('ix_checklistcoord_tid');
            $table->double('decimalLatitude');
            $table->double('decimalLongitude');
            $table->string('sourceName', 75)->nullable();
            $table->string('sourceIdentifier', 45)->nullable();
            $table->string('referenceUrl', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['clid', 'tid', 'decimalLatitude', 'decimalLongitude'], 'uq_checklistcoord_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmchklstcoordinates');
    }
};
