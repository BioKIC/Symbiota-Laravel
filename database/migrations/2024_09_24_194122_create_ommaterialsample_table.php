<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ommaterialsample', function (Blueprint $table) {
            $table->increments('matSampleID');
            $table->unsignedInteger('occid')->index('fk_ommatsample_occid_idx');
            $table->string('sampleType', 45)->index('ix_ommatsample_sampletype');
            $table->string('catalogNumber', 45)->nullable();
            $table->string('guid', 150)->nullable();
            $table->string('sampleCondition', 45)->nullable();
            $table->string('disposition', 45)->nullable();
            $table->string('preservationType', 45)->nullable();
            $table->string('preparationDetails', 250)->nullable();
            $table->date('preparationDate')->nullable();
            $table->unsignedInteger('preparedByUid')->nullable()->index('fk_ommatsample_prepuid_idx');
            $table->string('individualCount', 45)->nullable();
            $table->string('sampleSize', 45)->nullable();
            $table->string('storageLocation', 45)->nullable();
            $table->string('remarks', 250)->nullable();
            $table->json('dynamicFields')->nullable();
            $table->string('recordID', 45)->nullable()->unique('uq_ommatsample_recordid');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ommaterialsample');
    }
};
