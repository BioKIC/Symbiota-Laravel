<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmprojectcategories', function (Blueprint $table) {
            $table->increments('projcatid');
            $table->unsignedInteger('pid')->index('fk_fmprojcat_pid_idx');
            $table->string('categoryname', 150);
            $table->string('managers', 100)->nullable();
            $table->string('description', 250)->nullable();
            $table->integer('parentpid')->nullable();
            $table->integer('occurrencesearch')->nullable()->default(0);
            $table->integer('ispublic')->nullable()->default(1);
            $table->string('notes', 250)->nullable();
            $table->integer('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmprojectcategories');
    }
};
