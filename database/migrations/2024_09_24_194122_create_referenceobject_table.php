<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referenceobject', function (Blueprint $table) {
            $table->integer('refid', true);
            $table->integer('parentRefId')->nullable()->index('fk_refobj_parentrefid_idx');
            $table->integer('ReferenceTypeId')->nullable()->index('fk_refobj_typeid_idx');
            $table->string('title', 150)->index('index_refobj_title');
            $table->string('secondarytitle', 250)->nullable();
            $table->string('shorttitle', 250)->nullable();
            $table->string('tertiarytitle', 250)->nullable();
            $table->string('alternativetitle', 250)->nullable();
            $table->string('typework', 150)->nullable();
            $table->string('figures', 150)->nullable();
            $table->string('pubdate', 45)->nullable();
            $table->string('edition', 45)->nullable();
            $table->string('volume', 45)->nullable();
            $table->string('numbervolumnes', 45)->nullable();
            $table->string('number', 45)->nullable();
            $table->string('pages', 45)->nullable();
            $table->string('section', 45)->nullable();
            $table->string('placeofpublication', 45)->nullable();
            $table->string('publisher', 150)->nullable();
            $table->string('isbn_issn', 45)->nullable();
            $table->string('url', 150)->nullable();
            $table->string('guid', 45)->nullable();
            $table->string('ispublished', 45)->nullable();
            $table->string('notes', 45)->nullable();
            $table->string('cheatauthors', 400)->nullable();
            $table->string('cheatcitation', 500)->nullable();
            $table->unsignedInteger('modifieduid')->nullable();
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referenceobject');
    }
};
