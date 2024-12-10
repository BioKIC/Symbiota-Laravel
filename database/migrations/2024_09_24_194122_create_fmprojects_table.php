<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmprojects', function (Blueprint $table) {
            $table->increments('pid');
            $table->string('projname', 75);
            $table->string('displayname', 150)->nullable();
            $table->string('managers', 150)->nullable();
            $table->string('briefdescription', 300)->nullable();
            $table->string('fulldescription', 5000)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('iconUrl', 150)->nullable();
            $table->string('headerUrl', 150)->nullable();
            $table->unsignedInteger('occurrencesearch')->default(0);
            $table->unsignedInteger('ispublic')->default(0);
            $table->text('dynamicProperties')->nullable();
            $table->unsignedInteger('parentpid')->nullable()->index('fk_parentpid_proj');
            $table->unsignedInteger('SortSequence')->default(50);
            $table->timestamp('InitialTimeStamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmprojects');
    }
};
