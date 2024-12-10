<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurloansattachment', function (Blueprint $table) {
            $table->foreign(['exchangeid'], 'FK_occurloansattachment_exchangeid')->references(['exchangeid'])->on('omoccurexchange')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['loanid'], 'FK_occurloansattachment_loanid')->references(['loanid'])->on('omoccurloans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurloansattachment', function (Blueprint $table) {
            $table->dropForeign('FK_occurloansattachment_exchangeid');
            $table->dropForeign('FK_occurloansattachment_loanid');
        });
    }
};
