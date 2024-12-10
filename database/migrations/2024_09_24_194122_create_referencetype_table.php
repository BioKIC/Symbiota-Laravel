<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referencetype', function (Blueprint $table) {
            $table->integer('ReferenceTypeId', true);
            $table->string('ReferenceType', 45)->unique('referencetype_unique');
            $table->integer('IsParent')->nullable();
            $table->string('Title', 45)->nullable();
            $table->string('SecondaryTitle', 45)->nullable();
            $table->string('PlacePublished', 45)->nullable();
            $table->string('Publisher', 45)->nullable();
            $table->string('Volume', 45)->nullable();
            $table->string('NumberVolumes', 45)->nullable();
            $table->string('Number', 45)->nullable();
            $table->string('Pages', 45)->nullable();
            $table->string('Section', 45)->nullable();
            $table->string('TertiaryTitle', 45)->nullable();
            $table->string('Edition', 45)->nullable();
            $table->string('Date', 45)->nullable();
            $table->string('TypeWork', 45)->nullable();
            $table->string('ShortTitle', 45)->nullable();
            $table->string('AlternativeTitle', 45)->nullable();
            $table->string('ISBN_ISSN', 45)->nullable();
            $table->string('Figures', 45)->nullable();
            $table->integer('addedByUid')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referencetype');
    }
};
