<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('geographicthesaurus', function (Blueprint $table) {
            $table->integer('geoThesID', true);
            $table->string('geoterm', 100)->nullable()->index('ix_geothes_termname');
            $table->string('abbreviation', 45)->nullable()->index('ix_geothes_abbreviation');
            $table->string('iso2', 45)->nullable()->index('ix_geothes_iso2');
            $table->string('iso3', 45)->nullable()->index('ix_geothes_iso3');
            $table->integer('numcode')->nullable();
            $table->string('category', 45)->nullable();
            $table->integer('geoLevel');
            $table->integer('termstatus')->nullable();
            $table->integer('acceptedID')->nullable()->index('fk_geothes_acceptedid_idx');
            $table->integer('parentID')->nullable()->index('fk_geothes_parentid_idx');
            $table->string('notes', 250)->nullable();
            $table->text('dynamicProps')->nullable();
            $table->text('footprintWKT')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->unique(['geoterm', 'parentID'], 'uq_geothes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('geographicthesaurus');
    }
};
