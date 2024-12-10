<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ctcontrolvocabterm', function (Blueprint $table) {
            $table->integer('cvTermID', true);
            $table->integer('cvID')->index('fk_ctcontrolvocabterm_cvid_idx');
            $table->integer('parentCvTermID')->nullable()->index('fk_ctcontrolvocabterm_cvtermid');
            $table->string('term', 45)->index('ix_controlvocabterm_term');
            $table->string('termDisplay', 75)->nullable();
            $table->string('inverseRelationship', 45)->nullable();
            $table->string('collective', 45)->nullable();
            $table->string('definition', 250)->nullable();
            $table->string('resourceUrl', 150)->nullable();
            $table->string('ontologyClass', 150)->nullable();
            $table->string('ontologyUrl', 150)->nullable();
            $table->integer('activeStatus')->nullable()->default(1);
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('createdUid')->nullable()->index('fk_ctcontrolvocabterm_createuid_idx');
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_ctcontrolvocabterm_moduid_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['cvID', 'term'], 'uq_controlvocabterm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ctcontrolvocabterm');
    }
};
