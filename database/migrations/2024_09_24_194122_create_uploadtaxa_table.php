<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('uploadtaxa', function (Blueprint $table) {
            $table->unsignedInteger('TID')->nullable();
            $table->unsignedInteger('SourceId')->nullable()->index('sourceid_index');
            $table->string('Family', 50)->nullable();
            $table->smallInteger('RankId')->nullable();
            $table->string('RankName', 45)->nullable();
            $table->string('scinameinput', 250)->index('scinameinput_index');
            $table->string('SciName', 250)->nullable()->index('sciname_index');
            $table->string('UnitInd1', 1)->nullable();
            $table->string('UnitName1', 50)->nullable()->index('unitname1_index');
            $table->string('UnitInd2', 1)->nullable();
            $table->string('UnitName2', 50)->nullable();
            $table->string('UnitInd3', 45)->nullable();
            $table->string('UnitName3', 35)->nullable();
            $table->string('Author', 100)->nullable();
            $table->string('InfraAuthor', 100)->nullable();
            $table->string('taxonomicStatus', 45)->nullable();
            $table->unsignedInteger('Acceptance')->nullable()->default(1)->index('acceptance_index')->comment('0 = not accepted; 1 = accepted');
            $table->unsignedInteger('TidAccepted')->nullable();
            $table->string('AcceptedStr', 250)->nullable()->index('acceptedstr_index');
            $table->unsignedInteger('SourceAcceptedId')->nullable()->index('sourceacceptedid_index');
            $table->string('UnacceptabilityReason', 24)->nullable();
            $table->integer('ParentTid')->nullable();
            $table->string('ParentStr', 250)->nullable()->index('parentstr_index');
            $table->unsignedInteger('SourceParentId')->nullable()->index('sourceparentid_index');
            $table->unsignedInteger('SecurityStatus')->default(0)->comment('0 = no security; 1 = hidden locality');
            $table->string('Source', 250)->nullable();
            $table->string('Notes', 250)->nullable();
            $table->string('vernacular', 250)->nullable();
            $table->string('vernlang', 15)->nullable();
            $table->string('Hybrid', 50)->nullable();
            $table->string('ErrorStatus', 150)->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();

            $table->unique(['SciName', 'RankId', 'Author', 'AcceptedStr'], 'unique_sciname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('uploadtaxa');
    }
};
