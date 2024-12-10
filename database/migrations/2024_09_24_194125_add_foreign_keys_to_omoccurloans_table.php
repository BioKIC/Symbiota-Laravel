<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurloans', function (Blueprint $table) {
            $table->foreign(['collidBorr'], 'FK_occurloans_borrcoll')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['iidBorrower'], 'FK_occurloans_borrinst')->references(['iid'])->on('institutions')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['collidOwn'], 'FK_occurloans_owncoll')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['iidOwner'], 'FK_occurloans_owninst')->references(['iid'])->on('institutions')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurloans', function (Blueprint $table) {
            $table->dropForeign('FK_occurloans_borrcoll');
            $table->dropForeign('FK_occurloans_borrinst');
            $table->dropForeign('FK_occurloans_owncoll');
            $table->dropForeign('FK_occurloans_owninst');
        });
    }
};
