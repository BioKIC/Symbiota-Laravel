<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentnumberpattern', function (Blueprint $table) {
            $table->bigInteger('agentNumberPatternID')->primary();
            $table->bigInteger('agentID')->index('ix_agentnumberpattern_agentid');
            $table->string('numberType', 50)->nullable()->default('Collector number');
            $table->string('numberPattern')->nullable();
            $table->string('numberPatternDescription', 900)->nullable();
            $table->integer('startYear')->nullable();
            $table->integer('endYear')->nullable();
            $table->integer('integerIncrement')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentnumberpattern');
    }
};
