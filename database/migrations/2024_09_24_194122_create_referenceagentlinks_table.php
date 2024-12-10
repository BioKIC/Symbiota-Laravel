<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referenceagentlinks', function (Blueprint $table) {
            $table->integer('refid');
            $table->integer('agentid');
            $table->timestamp('initialtimestamp')->useCurrent();
            $table->integer('createdbyid');

            $table->primary(['refid', 'agentid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referenceagentlinks');
    }
};
