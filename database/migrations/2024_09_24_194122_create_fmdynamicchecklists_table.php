<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmdynamicchecklists', function (Blueprint $table) {
            $table->increments('dynclid');
            $table->string('name', 50)->nullable();
            $table->string('details', 250)->nullable();
            $table->string('uid', 45)->nullable();
            $table->string('type', 45)->default('DynamicList');
            $table->string('notes', 250)->nullable();
            $table->dateTime('expiration');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmdynamicchecklists');
    }
};
