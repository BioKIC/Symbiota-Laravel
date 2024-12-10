<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ctrelationshiptypes', function (Blueprint $table) {
            $table->string('relationship', 50)->primary();
            $table->string('inverse', 50)->nullable();
            $table->string('collective', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('ctrelationshiptypes');
    }
};
