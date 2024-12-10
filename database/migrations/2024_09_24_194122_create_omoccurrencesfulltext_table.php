<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurrencesfulltext', function (Blueprint $table) {
            $table->integer('occid')->primary();
            $table->text('locality')->nullable()->fulltext('ft_occur_locality');
            $table->string('recordedby')->nullable()->fulltext('ft_occur_recordedby');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurrencesfulltext');
    }
};
