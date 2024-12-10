<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referenceauthorlink', function (Blueprint $table) {
            $table->integer('refid')->index('fk_refauthlink_refid_idx');
            $table->integer('refauthid')->index('fk_refauthlink_refauthid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['refid', 'refauthid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referenceauthorlink');
    }
};
