<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('uploadglossary', function (Blueprint $table) {
            $table->string('term', 150)->nullable()->index('term_index');
            $table->string('definition', 1000)->nullable();
            $table->string('language', 45)->nullable();
            $table->string('source', 1000)->nullable();
            $table->string('author', 250)->nullable();
            $table->string('translator', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('resourceurl', 600)->nullable();
            $table->string('tidStr', 100)->nullable();
            $table->boolean('synonym')->nullable();
            $table->integer('newGroupId')->nullable()->index('relatedterm_index');
            $table->integer('currentGroupId')->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('uploadglossary');
    }
};
