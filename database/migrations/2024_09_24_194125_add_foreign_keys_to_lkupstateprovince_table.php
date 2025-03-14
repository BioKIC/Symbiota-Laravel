<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('lkupstateprovince', function (Blueprint $table) {
            $table->foreign(['countryId'], 'fk_country')->references(['countryId'])->on('lkupcountry')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('lkupstateprovince', function (Blueprint $table) {
            $table->dropForeign('fk_country');
        });
    }
};
