<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxadescrblock', function (Blueprint $table) {
            $table->increments('tdbid');
            $table->unsignedInteger('tdProfileID')->index('fk_taxadescrblock_tdprofileid_idx');
            $table->unsignedInteger('tid')->index('fk_taxadescrblock_tid_idx');
            $table->string('caption', 40)->nullable();
            $table->string('source', 250)->nullable();
            $table->string('sourceurl', 250)->nullable();
            $table->string('language', 45)->nullable()->default('English');
            $table->integer('langid')->nullable()->index('fk_taxadesc_lang_idx');
            $table->unsignedInteger('displaylevel')->default(1)->comment('1 = short descr, 2 = intermediate descr');
            $table->unsignedInteger('uid');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxadescrblock');
    }
};
