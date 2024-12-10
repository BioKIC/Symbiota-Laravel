<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocessorrawlabelsfulltext', function (Blueprint $table) {
            $table->integer('prlid')->primary();
            $table->integer('imgid')->index('index_ocr_imgid');
            $table->text('rawstr')->fulltext('index_ocr_fulltext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocessorrawlabelsfulltext');
    }
};
