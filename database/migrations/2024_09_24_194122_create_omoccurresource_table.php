<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurresource', function (Blueprint $table) {
            $table->increments('resourceID');
            $table->unsignedInteger('occid')->index('fk_omoccurresource_occid_idx');
            $table->string('reourceTitle', 45);
            $table->string('resourceType', 45);
            $table->string('uri', 250);
            $table->string('source', 45)->nullable();
            $table->string('resourceIdentifier', 45)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_omoccurresource_moduid_idx');
            $table->unsignedInteger('createdUid')->nullable()->index('fk_omoccurresource_createduid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurresource');
    }
};
