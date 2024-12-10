<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referenceauthors', function (Blueprint $table) {
            $table->integer('refauthorid', true);
            $table->string('lastname', 100)->index('index_refauthlastname');
            $table->string('firstname', 100)->nullable();
            $table->string('middlename', 100)->nullable();
            $table->unsignedInteger('modifieduid')->nullable();
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referenceauthors');
    }
};
