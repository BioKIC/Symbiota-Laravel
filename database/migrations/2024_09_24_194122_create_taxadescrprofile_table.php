<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxadescrprofile', function (Blueprint $table) {
            $table->increments('tdProfileID');
            $table->string('title', 150);
            $table->string('authors', 100)->nullable();
            $table->string('caption', 40);
            $table->string('projectDescription', 500)->nullable();
            $table->text('abstract')->nullable();
            $table->string('publication', 500)->nullable();
            $table->string('urlTemplate', 250)->nullable();
            $table->string('internalNotes', 250)->nullable();
            $table->integer('langid')->nullable()->default(1)->index('fk_taxadescrprofile_langid_idx');
            $table->integer('defaultDisplayLevel')->nullable()->default(1);
            $table->text('dynamicProperties')->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_taxadescrprofile_uid_idx');
            $table->timestamp('modifiedTimestamp')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxadescrprofile');
    }
};
