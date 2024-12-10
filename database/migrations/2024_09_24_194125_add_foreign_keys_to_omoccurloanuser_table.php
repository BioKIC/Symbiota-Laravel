<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurloanuser', function (Blueprint $table) {
            $table->foreign(['loanid'], 'FK_occurloan_loanid')->references(['loanid'])->on('omoccurloans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['modifiedByUid'], 'FK_occurloan_modifiedByUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['uid'], 'FK_occurloan_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurloanuser', function (Blueprint $table) {
            $table->dropForeign('FK_occurloan_loanid');
            $table->dropForeign('FK_occurloan_modifiedByUid');
            $table->dropForeign('FK_occurloan_uid');
        });
    }
};
