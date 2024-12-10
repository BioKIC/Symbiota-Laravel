<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tmtraittaxalink', function (Blueprint $table) {
            $table->unsignedInteger('traitid')->index('fk_traittaxalink_traitid_idx');
            $table->unsignedInteger('tid')->index('fk_traittaxalink_tid_idx');
            $table->string('relation', 45)->default('include');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['traitid', 'tid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tmtraittaxalink');
    }
};
