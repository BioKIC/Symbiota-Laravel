<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imageprojects', function (Blueprint $table) {
            $table->integer('imgprojid', true);
            $table->string('projectname', 75);
            $table->string('managers', 150)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('projectType', 45)->nullable();
            $table->unsignedInteger('collid')->nullable()->index('fk_imageproject_collid_idx');
            $table->integer('ispublic')->default(1);
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('uidcreated')->nullable()->index('fk_imageproject_uid_idx');
            $table->integer('sortsequence')->nullable()->default(50);
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imageprojects');
    }
};
