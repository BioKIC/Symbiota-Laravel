<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxonunits', function (Blueprint $table) {
            $table->integer('taxonunitid', true);
            $table->string('kingdomName', 45)->default('Organism');
            $table->unsignedSmallInteger('rankid')->default(0);
            $table->string('rankname', 15);
            $table->string('suffix', 45)->nullable();
            $table->smallInteger('dirparentrankid');
            $table->smallInteger('reqparentrankid')->nullable();
            $table->string('modifiedby', 45)->nullable();
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['kingdomName', 'rankid'], 'unique_taxonunits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxonunits');
    }
};
