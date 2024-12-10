<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxaprofilepubdesclink', function (Blueprint $table) {
            $table->unsignedInteger('tdbid');
            $table->integer('tppid')->index('fk_tppubdesclink_id_idx');
            $table->string('caption', 45)->nullable();
            $table->string('editornotes', 250)->nullable();
            $table->integer('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->primary(['tdbid', 'tppid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxaprofilepubdesclink');
    }
};
