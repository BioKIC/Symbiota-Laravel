<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('specprocnlpfrag', function (Blueprint $table) {
            $table->foreign(['spnlpid'], 'FK_specprocnlpfrag_spnlpid')->references(['spnlpid'])->on('specprocnlp')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('specprocnlpfrag', function (Blueprint $table) {
            $table->dropForeign('FK_specprocnlpfrag_spnlpid');
        });
    }
};
