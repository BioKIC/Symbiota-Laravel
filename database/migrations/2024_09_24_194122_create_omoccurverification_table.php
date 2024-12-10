<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurverification', function (Blueprint $table) {
            $table->integer('ovsid', true);
            $table->unsignedInteger('occid')->index('fk_omoccurverification_occid_idx');
            $table->string('category', 45);
            $table->integer('ranking');
            $table->string('protocol', 100)->nullable();
            $table->string('source', 45)->nullable();
            $table->unsignedInteger('uid')->nullable()->index('fk_omoccurverification_uid_idx');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->unique(['occid', 'category'], 'unique_omoccurverification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurverification');
    }
};
