<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcslang', function (Blueprint $table) {
            $table->unsignedInteger('cid');
            $table->string('cs', 16);
            $table->string('charstatename', 150);
            $table->string('language', 45);
            $table->integer('langid')->index('fk_cslang_lang_idx');
            $table->string('description')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('intialtimestamp')->useCurrent();

            $table->primary(['cid', 'cs', 'langid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcslang');
    }
};
