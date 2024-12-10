<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('lkupmunicipality', function (Blueprint $table) {
            $table->integer('municipalityId', true);
            $table->integer('stateId')->index('fk_stateprovince');
            $table->string('municipalityName', 100)->index('index_municipalityname');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['stateId', 'municipalityName'], 'unique_municipality');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lkupmunicipality');
    }
};
