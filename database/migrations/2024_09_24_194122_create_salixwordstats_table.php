<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('salixwordstats', function (Blueprint $table) {
            $table->integer('swsid', true);
            $table->string('firstword', 45);
            $table->string('secondword', 45)->nullable()->index('index_secondword');
            $table->integer('locality')->default(0);
            $table->integer('localityFreq')->default(0);
            $table->integer('habitat')->default(0);
            $table->integer('habitatFreq')->default(0);
            $table->integer('substrate')->default(0);
            $table->integer('substrateFreq')->default(0);
            $table->integer('verbatimAttributes')->default(0);
            $table->integer('verbatimAttributesFreq')->default(0);
            $table->integer('occurrenceRemarks')->default(0);
            $table->integer('occurrenceRemarksFreq')->default(0);
            $table->integer('totalcount')->default(0);
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->unique(['firstword', 'secondword'], 'index_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('salixwordstats');
    }
};
