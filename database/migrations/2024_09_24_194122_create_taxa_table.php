<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxa', function (Blueprint $table) {
            $table->increments('tid');
            $table->string('kingdomName', 45)->default('');
            $table->unsignedSmallInteger('rankID')->default(0)->index('rankid_index');
            $table->string('sciName', 250)->index('sciname_index');
            $table->string('unitInd1', 1)->nullable();
            $table->string('unitName1', 50);
            $table->string('unitInd2', 1)->nullable();
            $table->string('unitName2', 50)->nullable()->default('t');
            $table->string('unitInd3', 45)->nullable();
            $table->string('unitName3', 35)->nullable();
            $table->string('author', 150)->default('');
            $table->unsignedTinyInteger('phyloSortSequence')->nullable();
            $table->integer('reviewStatus')->nullable();
            $table->integer('displayStatus')->nullable();
            $table->integer('isLegitimate')->nullable();
            $table->string('nomenclaturalStatus', 45)->nullable();
            $table->string('nomenclaturalCode', 45)->nullable();
            $table->string('statusNotes', 50)->nullable();
            $table->string('source', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('hybrid', 50)->nullable();
            $table->unsignedInteger('securityStatus')->default(0)->comment('0 = no security; 1 = hidden locality');
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_taxa_uid_idx');
            $table->dateTime('modifiedTimeStamp')->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent()->index('idx_taxacreated');

            $table->index(['unitName1', 'unitName2'], 'unitname1_index');
            $table->unique(['sciName', 'rankID', 'kingdomName'], 'uq_taxa_sciname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxa');
    }
};
