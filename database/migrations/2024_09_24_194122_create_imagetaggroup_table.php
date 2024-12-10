<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imagetaggroup', function (Blueprint $table) {
            $table->integer('imgTagGroupID', true);
            $table->string('groupName', 45)->index('ix_imagetaggroup');
            $table->string('category', 45)->nullable();
            $table->string('resourceUrl', 150)->nullable();
            $table->string('audubonCoreTarget', 45)->nullable();
            $table->string('controlType', 45)->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imagetaggroup');
    }
};
