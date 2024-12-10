<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omcollpuboccurlink', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_ompuboccid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['pubid'], 'FK_ompubpubid')->references(['pubid'])->on('omcollpublications')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omcollpuboccurlink', function (Blueprint $table) {
            $table->dropForeign('FK_ompuboccid');
            $table->dropForeign('FK_ompubpubid');
        });
    }
};
