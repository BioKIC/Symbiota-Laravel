<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccuridentifiers', function (Blueprint $table) {
            $table->integer('idomoccuridentifiers', true);
            $table->unsignedInteger('occid')->index('fk_omoccuridentifiers_occid_idx');
            $table->string('identifiervalue', 45)->index('ix_omoccuridentifiers_value');
            $table->string('identifiername', 45)->default('')->comment('barcode, accession number, old catalog number, NPS, etc');
            $table->string('notes', 250)->nullable();
            $table->integer('sortBy')->nullable();
            $table->unsignedInteger('modifiedUid');
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['occid', 'identifiervalue', 'identifiername'], 'uq_omoccuridentifiers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccuridentifiers');
    }
};
