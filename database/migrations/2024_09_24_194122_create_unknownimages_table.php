<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('unknownimages', function (Blueprint $table) {
            $table->increments('unkimgid');
            $table->unsignedInteger('unkid')->index('fk_unknowns');
            $table->string('url');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('unknownimages');
    }
};
