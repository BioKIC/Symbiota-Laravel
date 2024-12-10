<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcrowdsourceproject', function (Blueprint $table) {
            $table->integer('csProjID', true);
            $table->string('title', 45);
            $table->string('description', 250)->nullable();
            $table->text('instructions')->nullable();
            $table->string('trainingurl', 250)->nullable();
            $table->string('managers', 150)->nullable();
            $table->string('criteria', 1500)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_croudsourceproj_uid_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcrowdsourceproject');
    }
};
