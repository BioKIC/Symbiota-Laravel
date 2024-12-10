<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollcategories', function (Blueprint $table) {
            $table->increments('ccpk');
            $table->string('category', 75);
            $table->string('icon', 250)->nullable();
            $table->string('acronym', 45)->nullable();
            $table->string('url', 250)->nullable();
            $table->integer('inclusive')->nullable()->default(1);
            $table->string('notes', 250)->nullable();
            $table->integer('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollcategories');
    }
};
