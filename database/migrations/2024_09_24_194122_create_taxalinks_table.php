<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxalinks', function (Blueprint $table) {
            $table->increments('tlid');
            $table->unsignedInteger('tid')->index('fk_taxalinks_tid');
            $table->string('url', 500);
            $table->string('title', 100);
            $table->string('sourceIdentifier', 45)->nullable();
            $table->string('owner', 100)->nullable();
            $table->string('icon', 45)->nullable();
            $table->integer('inherit')->nullable()->default(1);
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('sortsequence')->default(50);
            $table->timestamp('initialTimestamp')->useCurrentOnUpdate()->useCurrent();

            $table->unique(['tid', 'url'], 'uq_taxalinks_tid_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxalinks');
    }
};
