<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('actionrequesttype', function (Blueprint $table) {
            $table->string('requesttype', 30)->primary();
            $table->string('context')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('actionrequesttype');
    }
};
