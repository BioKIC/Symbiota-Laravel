<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcharheading', function (Blueprint $table) {
            $table->increments('hid');
            $table->string('headingname')->index('headingname');
            $table->string('language', 45)->nullable()->default('English');
            $table->integer('langid')->index('fk_kmcharheading_lang_idx');
            $table->longText('notes')->nullable();
            $table->integer('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['hid', 'langid']);
            $table->unique(['headingname', 'langid'], 'unique_kmcharheading');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcharheading');
    }
};
