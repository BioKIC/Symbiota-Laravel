<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('ctcontrolvocab', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_ctControlVocab_collid')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_ctControlVocab_createUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['modifiedUid'], 'FK_ctControlVocab_modUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('ctcontrolvocab', function (Blueprint $table) {
            $table->dropForeign('FK_ctControlVocab_collid');
            $table->dropForeign('FK_ctControlVocab_createUid');
            $table->dropForeign('FK_ctControlVocab_modUid');
        });
    }
};
