<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('configpage', function (Blueprint $table) {
            $table->integer('configpageid', true);
            $table->string('pagename', 45);
            $table->string('title', 150);
            $table->string('cssname', 45)->nullable();
            $table->string('language', 45)->default('english');
            $table->integer('displaymode')->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedUid');
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('configpage');
    }
};
