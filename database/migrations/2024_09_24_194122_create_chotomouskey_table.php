<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('chotomouskey', function (Blueprint $table) {
            $table->increments('stmtid');
            $table->string('statement', 300);
            $table->unsignedInteger('nodeid');
            $table->unsignedInteger('parentid');
            $table->unsignedInteger('tid')->nullable()->index('fk_chotomouskey_taxa');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chotomouskey');
    }
};
