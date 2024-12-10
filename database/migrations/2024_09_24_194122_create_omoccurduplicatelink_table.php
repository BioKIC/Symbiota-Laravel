<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurduplicatelink', function (Blueprint $table) {
            $table->unsignedInteger('occid')->index('fk_omoccurdupelink_occid_idx');
            $table->integer('duplicateid')->index('fk_omoccurdupelink_dupeid_idx');
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedUid')->nullable();
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['occid', 'duplicateid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurduplicatelink');
    }
};
