<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcharheadinglang', function (Blueprint $table) {
            $table->unsignedInteger('hid');
            $table->integer('langid')->index('fk_kmcharheadinglang_langid');
            $table->string('headingname', 100);
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->primary(['hid', 'langid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcharheadinglang');
    }
};
