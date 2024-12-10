<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmchklsttaxalink', function (Blueprint $table) {
            $table->increments('clTaxaID');
            $table->unsignedInteger('tid')->index('fk_chklsttaxalink_tid');
            $table->unsignedInteger('clid')->index('fk_chklsttaxalink_cid');
            $table->string('morphoSpecies', 45)->nullable()->default('');
            $table->string('familyOverride', 50)->nullable();
            $table->string('habitat', 250)->nullable();
            $table->string('abundance', 50)->nullable();
            $table->string('notes', 2000)->nullable();
            $table->smallInteger('explicitExclude')->nullable();
            $table->string('source', 250)->nullable();
            $table->string('nativity', 50)->nullable()->comment('native, introducted');
            $table->string('endemic', 45)->nullable();
            $table->string('invasive', 45)->nullable();
            $table->string('internalNotes', 250)->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['clid', 'tid', 'morphoSpecies'], 'uq_chklsttaxalink');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmchklsttaxalink');
    }
};
