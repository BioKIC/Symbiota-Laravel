<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omexsiccatititles', function (Blueprint $table) {
            $table->increments('ometid');
            $table->string('title', 150)->index('index_exsiccatititle');
            $table->string('abbreviation', 100)->nullable();
            $table->string('editor', 150)->nullable();
            $table->string('exsrange', 45)->nullable();
            $table->string('startdate', 45)->nullable();
            $table->string('enddate', 45)->nullable();
            $table->string('source', 250)->nullable();
            $table->string('sourceIdentifier', 150)->nullable();
            $table->string('notes', 2000)->nullable();
            $table->string('lasteditedby', 45)->nullable();
            $table->string('recordID', 45)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omexsiccatititles');
    }
};
