<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocnlpversion', function (Blueprint $table) {
            $table->comment('Archives field name - value pairs of NLP results loading int');
            $table->integer('nlpverid', true);
            $table->unsignedInteger('prlid')->index('fk_specprocnlpver_rawtext_idx');
            $table->text('archivestr');
            $table->string('processingvariables', 250)->nullable();
            $table->integer('score')->nullable();
            $table->string('source', 150)->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocnlpversion');
    }
};
