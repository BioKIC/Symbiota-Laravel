<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('ctcontrolvocabterm', function (Blueprint $table) {
            $table->foreign(['createdUid'], 'FK_ctControlVocabTerm_createUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['cvID'], 'FK_ctControlVocabTerm_cvID')->references(['cvID'])->on('ctcontrolvocab')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['parentCvTermID'], 'FK_ctControlVocabTerm_cvTermID')->references(['cvTermID'])->on('ctcontrolvocabterm')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['modifiedUid'], 'FK_ctControlVocabTerm_modUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('ctcontrolvocabterm', function (Blueprint $table) {
            $table->dropForeign('FK_ctControlVocabTerm_createUid');
            $table->dropForeign('FK_ctControlVocabTerm_cvID');
            $table->dropForeign('FK_ctControlVocabTerm_cvTermID');
            $table->dropForeign('FK_ctControlVocabTerm_modUid');
        });
    }
};
