<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxauthority', function (Blueprint $table) {
            $table->increments('taxauthid');
            $table->unsignedInteger('isprimary')->default(0);
            $table->string('name', 45);
            $table->string('description', 250)->nullable();
            $table->string('editors', 150)->nullable();
            $table->string('contact', 45)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('url', 150)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('isactive')->default(1);
            $table->timestamp('initialtimestamp')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxauthority');
    }
};
