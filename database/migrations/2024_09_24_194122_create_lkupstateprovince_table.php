<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('lkupstateprovince', function (Blueprint $table) {
            $table->integer('stateId', true);
            $table->integer('countryId')->index('fk_country');
            $table->string('stateName', 100)->index('index_statename');
            $table->string('abbrev', 3)->nullable()->index('index_lkupstate_abbr');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['stateName', 'countryId'], 'state_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lkupstateprovince');
    }
};
