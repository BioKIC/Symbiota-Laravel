<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmchecklists', function (Blueprint $table) {
            $table->increments('clid');
            $table->string('name', 100);
            $table->string('title', 150)->nullable();
            $table->string('locality', 500)->nullable();
            $table->string('publication', 500)->nullable();
            $table->text('abstract')->nullable();
            $table->string('authors', 250)->nullable();
            $table->string('type', 50)->nullable()->default('static');
            $table->string('politicalDivision', 45)->nullable();
            $table->string('dynamicSql', 500)->nullable();
            $table->string('parent', 50)->nullable();
            $table->unsignedInteger('parentClid')->nullable();
            $table->string('notes', 500)->nullable();
            $table->double('latCentroid')->nullable();
            $table->double('longCentroid')->nullable();
            $table->unsignedInteger('pointRadiusMeters')->nullable();
            $table->text('footprintWkt')->nullable();
            $table->integer('percentEffort')->nullable();
            $table->string('access', 45)->nullable()->default('private');
            $table->string('cidKeyLimits', 250)->nullable();
            $table->string('defaultSettings', 250)->nullable();
            $table->string('iconUrl', 150)->nullable();
            $table->string('headerUrl', 150)->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->unsignedInteger('uid')->nullable()->index('fk_checklists_uid');
            $table->unsignedInteger('sortSequence')->default(50);
            $table->unsignedInteger('expiration')->nullable();
            $table->string('guid', 45)->nullable();
            $table->string('recordID', 45)->nullable();
            $table->unsignedInteger('modifiedUid')->nullable();
            $table->dateTime('dateLastModified')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
            $table->text('footprintGeoJson')->nullable();

            $table->index(['name', 'type'], 'name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmchecklists');
    }
};
