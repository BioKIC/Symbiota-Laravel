<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccuraccesssummarylink', function (Blueprint $table) {
            $table->foreign(['oasid'], 'FK_omoccuraccesssummarylink_oasid')->references(['oasid'])->on('omoccuraccesssummary')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['occid'], 'FK_omoccuraccesssummarylink_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccuraccesssummarylink', function (Blueprint $table) {
            $table->dropForeign('FK_omoccuraccesssummarylink_oasid');
            $table->dropForeign('FK_omoccuraccesssummarylink_occid');
        });
    }
};
