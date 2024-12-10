<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('lkupcountry', function (Blueprint $table) {
            $table->integer('countryId', true);
            $table->string('countryName', 100)->unique('country_unique');
            $table->string('iso', 2)->nullable()->index('index_lkupcountry_iso');
            $table->string('iso3', 3)->nullable()->index('index_lkupcountry_iso3');
            $table->integer('numcode')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lkupcountry');
    }
};
