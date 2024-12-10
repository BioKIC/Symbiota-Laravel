<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ctcontrolvocab', function (Blueprint $table) {
            $table->integer('cvID', true);
            $table->unsignedInteger('collid')->nullable()->index('fk_ctcontrolvocab_collid_idx');
            $table->string('title', 45);
            $table->string('definition', 250)->nullable();
            $table->string('authors', 150)->nullable();
            $table->string('tableName', 45);
            $table->string('fieldName', 45);
            $table->string('filterVariable', 150)->default('');
            $table->string('resourceUrl', 150)->nullable();
            $table->string('ontologyClass', 150)->nullable();
            $table->string('ontologyUrl', 150)->nullable();
            $table->integer('limitToList')->nullable()->default(0);
            $table->text('dynamicProperties')->nullable();
            $table->string('notes', 45)->nullable();
            $table->unsignedInteger('createdUid')->nullable()->index('fk_ctcontrolvocab_createuid_idx');
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_ctcontrolvocab_moduid_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['title', 'tableName', 'fieldName', 'filterVariable'], 'uq_ctcontrolvocab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ctcontrolvocab');
    }
};
