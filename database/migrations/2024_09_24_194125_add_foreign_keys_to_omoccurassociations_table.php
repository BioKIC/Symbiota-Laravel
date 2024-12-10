<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurassociations', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_occurassoc_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['occidAssociate'], 'FK_occurassoc_occidassoc')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['tid'], 'FK_occurassoc_tid')->references(['TID'])->on('taxa')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['createdUid'], 'FK_occurassoc_uidcreated')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['modifiedUid'], 'FK_occurassoc_uidmodified')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurassociations', function (Blueprint $table) {
            $table->dropForeign('FK_occurassoc_occid');
            $table->dropForeign('FK_occurassoc_occidassoc');
            $table->dropForeign('FK_occurassoc_tid');
            $table->dropForeign('FK_occurassoc_uidcreated');
            $table->dropForeign('FK_occurassoc_uidmodified');
        });
    }
};
