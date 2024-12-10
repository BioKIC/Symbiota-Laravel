<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurloanslink', function (Blueprint $table) {
            $table->foreign(['loanid'], 'FK_occurloanlink_loanid')->references(['loanid'])->on('omoccurloans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['occid'], 'FK_occurloanlink_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurloanslink', function (Blueprint $table) {
            $table->dropForeign('FK_occurloanlink_loanid');
            $table->dropForeign('FK_occurloanlink_occid');
        });
    }
};
