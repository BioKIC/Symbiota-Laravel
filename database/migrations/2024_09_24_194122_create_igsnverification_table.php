<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('igsnverification', function (Blueprint $table) {
            $table->string('igsn', 15)->index('index_igsn');
            $table->unsignedInteger('occidInPortal')->nullable()->index('fk_igsn_occid_idx');
            $table->unsignedInteger('occidInSesar')->nullable();
            $table->string('catalogNumber', 45)->nullable();
            $table->string('syncStatus', 45)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('igsnverification');
    }
};
