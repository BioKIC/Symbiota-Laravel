<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcharacters', function (Blueprint $table) {
            $table->increments('cid');
            $table->string('charname', 150)->index('index_charname');
            $table->string('chartype', 2)->default('UM');
            $table->string('defaultlang', 45)->default('English');
            $table->unsignedSmallInteger('difficultyrank')->default(1);
            $table->unsignedInteger('hid')->nullable()->index('fk_charheading_idx');
            $table->string('units', 45)->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('glossid')->nullable()->index('fk_kmchar_glossary_idx');
            $table->string('helpurl', 500)->nullable();
            $table->string('referenceUrl', 250)->nullable();
            $table->string('notes')->nullable();
            $table->integer('activationCode')->nullable();
            $table->unsignedInteger('sortsequence')->nullable()->index('index_sort');
            $table->string('enteredby', 45)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcharacters');
    }
};
