<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('configpageattributes', function (Blueprint $table) {
            $table->integer('attributeid', true);
            $table->integer('configpageid')->index('fk_configpageattributes_id_idx');
            $table->string('objid', 45)->nullable();
            $table->string('objname', 45);
            $table->string('value', 45)->nullable();
            $table->string('type', 45)->nullable()->comment('text, submit, div');
            $table->integer('width')->nullable();
            $table->integer('top')->nullable();
            $table->integer('left')->nullable();
            $table->string('stylestr', 45)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedUid');
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('configpageattributes');
    }
};
