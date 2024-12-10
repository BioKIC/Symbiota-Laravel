<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmchklstprojlink', function (Blueprint $table) {
            $table->unsignedInteger('pid');
            $table->unsignedInteger('clid')->index('fk_chklst');
            $table->string('clNameOverride', 100)->nullable();
            $table->smallInteger('mapChecklist')->nullable()->default(1);
            $table->integer('sortSequence')->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();

            $table->primary(['pid', 'clid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmchklstprojlink');
    }
};
