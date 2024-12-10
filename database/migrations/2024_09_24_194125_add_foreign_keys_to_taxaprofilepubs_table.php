<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxaprofilepubs', function (Blueprint $table) {
            $table->foreign(['uidowner'], 'FK_taxaprofilepubs_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxaprofilepubs', function (Blueprint $table) {
            $table->dropForeign('FK_taxaprofilepubs_uid');
        });
    }
};
