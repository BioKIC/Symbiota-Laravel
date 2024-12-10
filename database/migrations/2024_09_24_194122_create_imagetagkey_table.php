<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imagetagkey', function (Blueprint $table) {
            $table->string('tagkey', 30)->primary();
            $table->integer('imgTagGroupID')->nullable()->index('fk_imagetagkey_imgtaggroupid_idx');
            $table->string('shortlabel', 30);
            $table->string('description_en');
            $table->string('tagDescription');
            $table->string('resourceLink', 250)->nullable();
            $table->string('audubonCoreTarget', 45)->nullable();
            $table->integer('sortorder')->index('sortorder');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imagetagkey');
    }
};
