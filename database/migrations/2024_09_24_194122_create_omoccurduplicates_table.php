<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurduplicates', function (Blueprint $table) {
            $table->integer('duplicateid', true);
            $table->string('title', 50);
            $table->string('description')->nullable();
            $table->string('notes')->nullable();
            $table->string('dupeType', 45)->default('Exact Duplicate');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurduplicates');
    }
};
