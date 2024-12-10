<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurpaleogts', function (Blueprint $table) {
            $table->increments('gtsid');
            $table->string('gtsterm', 45);
            $table->integer('rankid');
            $table->string('rankname', 45)->nullable();
            $table->unsignedInteger('parentgtsid')->nullable()->index('fk_gtsparent_idx');
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->unique(['gtsid'], 'unique_gtsterm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurpaleogts');
    }
};
