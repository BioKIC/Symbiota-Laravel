<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imagetag', function (Blueprint $table) {
            $table->bigInteger('imagetagid', true);
            $table->unsignedInteger('imgid')->index('fk_imagetag_imgid_idx');
            $table->string('keyvalue', 30)->index('keyvalue');
            $table->string('imageBoundingBox', 45)->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['imgid', 'keyvalue'], 'imgid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imagetag');
    }
};
