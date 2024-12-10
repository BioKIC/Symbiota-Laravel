<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referenceoccurlink', function (Blueprint $table) {
            $table->integer('refid')->index('fk_refoccurlink_refid_idx');
            $table->unsignedInteger('occid')->index('fk_refoccurlink_occid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['refid', 'occid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referenceoccurlink');
    }
};
