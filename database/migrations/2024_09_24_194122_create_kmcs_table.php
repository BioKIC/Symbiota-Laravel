<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmcs', function (Blueprint $table) {
            $table->unsignedInteger('cid')->default(0)->index('fk_cs_chars');
            $table->string('cs', 16);
            $table->string('CharStateName')->nullable();
            $table->boolean('Implicit')->default(false);
            $table->longText('Notes')->nullable();
            $table->string('Description')->nullable();
            $table->string('IllustrationUrl', 250)->nullable();
            $table->string('referenceUrl', 250)->nullable();
            $table->unsignedInteger('glossid')->nullable()->index('fk_kmcs_glossid_idx');
            $table->unsignedInteger('StateID')->nullable();
            $table->unsignedInteger('SortSequence')->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();
            $table->string('EnteredBy', 45)->nullable();

            $table->primary(['cs', 'cid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmcs');
    }
};
