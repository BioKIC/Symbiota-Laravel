<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referencedatasetlink', function (Blueprint $table) {
            $table->foreign(['datasetid'], 'FK_refdataset_datasetid')->references(['datasetID'])->on('omoccurdatasets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['refid'], 'FK_refdataset_refid')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_refdataset_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referencedatasetlink', function (Blueprint $table) {
            $table->dropForeign('FK_refdataset_datasetid');
            $table->dropForeign('FK_refdataset_refid');
            $table->dropForeign('FK_refdataset_uid');
        });
    }
};
