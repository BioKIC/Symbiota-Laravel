<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tmstates', function (Blueprint $table) {
            $table->increments('stateid');
            $table->unsignedInteger('traitid');
            $table->string('statecode', 2);
            $table->string('statename', 75);
            $table->string('description', 250)->nullable();
            $table->string('refurl', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->integer('sortseq')->nullable();
            $table->unsignedInteger('modifieduid')->nullable()->index('fk_tmstate_uidmodified_idx');
            $table->dateTime('datelastmodified')->nullable();
            $table->unsignedInteger('createduid')->nullable()->index('fk_tmstate_uidcreated_idx');
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->unique(['traitid', 'statecode'], 'traitid_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tmstates');
    }
};
