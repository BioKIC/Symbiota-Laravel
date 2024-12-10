<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('lkupcounty', function (Blueprint $table) {
            $table->integer('countyId', true);
            $table->integer('stateId')->index('fk_stateprovince');
            $table->string('countyName', 100)->index('index_countyname');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['stateId', 'countyName'], 'unique_county');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lkupcounty');
    }
};
