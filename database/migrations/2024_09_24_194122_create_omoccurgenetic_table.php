<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurgenetic', function (Blueprint $table) {
            $table->integer('idoccurgenetic', true);
            $table->unsignedInteger('occid')->index('fk_omoccurgenetic');
            $table->string('identifier', 150)->nullable();
            $table->string('resourcename', 150)->index('index_omoccurgenetic_name');
            $table->string('title', 150)->nullable();
            $table->string('locus', 500)->nullable();
            $table->string('resourceurl', 500)->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['occid', 'resourceurl'], 'unique_omoccurgenetic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurgenetic');
    }
};
