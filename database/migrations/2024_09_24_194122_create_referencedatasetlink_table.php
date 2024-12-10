<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referencedatasetlink', function (Blueprint $table) {
            $table->integer('refid');
            $table->unsignedInteger('datasetid')->index('fk_refdataset_datasetid_idx');
            $table->unsignedInteger('createdUid')->nullable()->index('fk_refdataset_uid_idx');
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->primary(['refid', 'datasetid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referencedatasetlink');
    }
};
