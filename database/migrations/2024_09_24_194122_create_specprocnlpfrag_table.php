<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocnlpfrag', function (Blueprint $table) {
            $table->integer('spnlpfragid', true);
            $table->integer('spnlpid')->index('fk_specprocnlpfrag_spnlpid');
            $table->string('fieldname', 45);
            $table->string('patternmatch', 250);
            $table->string('notes', 250)->nullable();
            $table->integer('sortseq')->nullable()->default(50);
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocnlpfrag');
    }
};
