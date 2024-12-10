<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurrencetypes', function (Blueprint $table) {
            $table->increments('occurtypeid');
            $table->unsignedInteger('occid')->nullable()->index('fk_occurtype_occid_idx');
            $table->string('typestatus', 45)->nullable();
            $table->string('typeDesignationType', 45)->nullable();
            $table->string('typeDesignatedBy', 45)->nullable();
            $table->string('scientificName', 250)->nullable();
            $table->string('scientificNameAuthorship', 45)->nullable();
            $table->unsignedInteger('tidinterpreted')->nullable()->index('fk_occurtype_tid_idx');
            $table->string('basionym', 250)->nullable();
            $table->integer('refid')->nullable()->index('fk_occurtype_refid_idx');
            $table->string('bibliographicCitation', 250)->nullable();
            $table->string('dynamicProperties', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurrencetypes');
    }
};
