<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxadescrprofile', function (Blueprint $table) {
            $table->foreign(['langid'], 'FK_taxadescrprofile_langid')->references(['langid'])->on('adminlanguages')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['modifiedUid'], 'FK_taxadescrprofile_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxadescrprofile', function (Blueprint $table) {
            $table->dropForeign('FK_taxadescrprofile_langid');
            $table->dropForeign('FK_taxadescrprofile_uid');
        });
    }
};
