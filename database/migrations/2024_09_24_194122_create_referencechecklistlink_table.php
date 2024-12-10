<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referencechecklistlink', function (Blueprint $table) {
            $table->integer('refid')->index('fk_refcheckllistlink_refid_idx');
            $table->unsignedInteger('clid')->index('fk_refcheckllistlink_clid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['refid', 'clid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referencechecklistlink');
    }
};
