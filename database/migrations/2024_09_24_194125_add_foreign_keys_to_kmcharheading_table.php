<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcharheading', function (Blueprint $table) {
            $table->foreign(['langid'], 'FK_kmcharheading_lang')->references(['langid'])->on('adminlanguages')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcharheading', function (Blueprint $table) {
            $table->dropForeign('FK_kmcharheading_lang');
        });
    }
};
