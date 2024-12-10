<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('adminlanguages', function (Blueprint $table) {
            $table->integer('langid', true);
            $table->string('langname', 45)->unique('index_langname_unique');
            $table->string('iso639_1', 10)->nullable();
            $table->string('iso639_2', 10)->nullable();
            $table->string('ISO 639-3', 3)->nullable();
            $table->string('notes', 45)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('adminlanguages');
    }
};
