<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossaryimages', function (Blueprint $table) {
            $table->increments('glimgid');
            $table->unsignedInteger('glossid')->index('fk_glossaryimages_gloss');
            $table->string('url');
            $table->string('thumbnailurl')->nullable();
            $table->string('structures', 150)->nullable();
            $table->integer('sortSequence')->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('createdBy', 250)->nullable();
            $table->unsignedInteger('uid')->nullable()->index('fk_glossaryimages_uid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossaryimages');
    }
};
