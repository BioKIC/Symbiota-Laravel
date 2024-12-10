<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossarycategory', function (Blueprint $table) {
            $table->integer('glossCatID', true);
            $table->string('category', 45)->nullable()->index('ix_glossarycategory_cat');
            $table->integer('rankID')->nullable()->default(10);
            $table->integer('langID')->nullable()->index('fk_glossarycategory_lang_idx');
            $table->integer('parentCatID')->nullable()->index('fk_glossarycategory_parentcatid_idx');
            $table->integer('translationCatID')->nullable()->index('fk_glossarycategory_transcatid_idx');
            $table->string('notes', 150)->nullable();
            $table->unsignedInteger('modifiedUid')->nullable();
            $table->timestamp('modifiedTimestamp')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->unique(['category', 'langID', 'rankID'], 'uq_glossary_category_term');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossarycategory');
    }
};
