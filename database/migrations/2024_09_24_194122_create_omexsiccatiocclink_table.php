<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omexsiccatiocclink', function (Blueprint $table) {
            $table->unsignedInteger('omenid')->index('fkexsiccatinumocclink1');
            $table->unsignedInteger('occid')->index('fkexsiccatinumocclink2');
            $table->integer('ranking')->default(50);
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['omenid', 'occid']);
            $table->unique(['occid'], 'uniqueomexsiccatiocclink');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omexsiccatiocclink');
    }
};
