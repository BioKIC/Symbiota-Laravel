<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossary', function (Blueprint $table) {
            $table->increments('glossid');
            $table->string('term', 150)->index('index_term');
            $table->string('plural', 150)->nullable()->index('ix_gloassary_plural');
            $table->string('termType', 45)->nullable();
            $table->string('definition', 2000)->nullable();
            $table->string('language', 45)->default('English')->index('index_glossary_lang');
            $table->unsignedInteger('langid')->nullable();
            $table->string('origin', 45)->nullable();
            $table->string('source', 1000)->nullable();
            $table->string('translator', 250)->nullable();
            $table->string('author', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('notesInternal', 250)->nullable();
            $table->string('resourceUrl', 600)->nullable();
            $table->unsignedInteger('uid')->nullable()->index('fk_glossary_uid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossary');
    }
};
