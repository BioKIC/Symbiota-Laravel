<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcsimages', function (Blueprint $table) {
            $table->increments('csimgid');
            $table->unsignedInteger('cid');
            $table->string('cs', 16);
            $table->string('url');
            $table->string('notes', 250)->nullable();
            $table->string('sortsequence', 45)->default('50');
            $table->string('username', 45)->nullable();
            $table->timestamp('initialtimestamp')->useCurrentOnUpdate()->useCurrent();

            $table->index(['cid', 'cs'], 'fk_kscsimages_kscs_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcsimages');
    }
};
