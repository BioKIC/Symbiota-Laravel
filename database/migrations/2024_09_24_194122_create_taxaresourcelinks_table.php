<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxaresourcelinks', function (Blueprint $table) {
            $table->integer('taxaresourceid', true);
            $table->unsignedInteger('tid')->index('fk_taxaresource_tid_idx');
            $table->string('sourcename', 150)->index('taxaresource_name');
            $table->string('sourceidentifier', 45)->nullable();
            $table->string('sourceguid', 150)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->integer('ranking')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['tid', 'sourcename'], 'unique_taxaresource');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxaresourcelinks');
    }
};
