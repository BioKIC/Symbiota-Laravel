<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocnlp', function (Blueprint $table) {
            $table->integer('spnlpid', true);
            $table->string('title', 45);
            $table->string('sqlfrag', 250);
            $table->string('patternmatch', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('collid')->index('fk_specprocnlp_collid');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocnlp');
    }
};
