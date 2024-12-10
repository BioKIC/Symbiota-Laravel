<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tmtraits', function (Blueprint $table) {
            $table->increments('traitid');
            $table->string('traitname', 100)->index('traitsname');
            $table->string('traittype', 2)->default('UM');
            $table->string('units', 45)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('refurl', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('projectGroup', 45)->nullable();
            $table->integer('isPublic')->nullable()->default(1);
            $table->integer('includeInSearch')->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->unsignedInteger('modifieduid')->nullable()->index('fk_traits_uidmodified_idx');
            $table->dateTime('datelastmodified')->nullable();
            $table->unsignedInteger('createduid')->nullable()->index('fk_traits_uidcreated_idx');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tmtraits');
    }
};
