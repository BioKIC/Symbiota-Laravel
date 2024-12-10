<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossarysources', function (Blueprint $table) {
            $table->unsignedInteger('tid')->primary();
            $table->string('contributorTerm', 1000)->nullable();
            $table->string('contributorImage', 1000)->nullable();
            $table->string('translator', 1000)->nullable();
            $table->string('additionalSources', 1000)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossarysources');
    }
};
