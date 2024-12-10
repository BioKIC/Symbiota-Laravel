<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprococrfrag', function (Blueprint $table) {
            $table->increments('ocrfragid');
            $table->unsignedInteger('prlid')->index('fk_specprococrfrag_prlid_idx');
            $table->string('firstword', 45);
            $table->string('secondword', 45)->nullable();
            $table->string('keyterm', 45)->nullable()->index('index_keyterm');
            $table->integer('wordorder')->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprococrfrag');
    }
};
