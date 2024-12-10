<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcharacterlang', function (Blueprint $table) {
            $table->unsignedInteger('cid');
            $table->string('charname', 150);
            $table->string('language', 45)->nullable();
            $table->integer('langid')->index('fk_charlang_lang_idx');
            $table->string('notes')->nullable();
            $table->string('description')->nullable();
            $table->string('helpurl', 500)->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();

            $table->primary(['cid', 'langid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcharacterlang');
    }
};
