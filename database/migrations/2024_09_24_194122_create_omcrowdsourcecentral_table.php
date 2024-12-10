<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcrowdsourcecentral', function (Blueprint $table) {
            $table->integer('omcsid', true);
            $table->unsignedInteger('collid')->index('fk_omcrowdsourcecentral_collid');
            $table->text('instructions')->nullable();
            $table->string('trainingurl', 500)->nullable();
            $table->integer('editorlevel')->default(0)->comment('0=public, 1=public limited, 2=private');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['collid'], 'index_omcrowdsourcecentral_collid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcrowdsourcecentral');
    }
};
