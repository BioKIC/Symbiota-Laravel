<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentsfulltext', function (Blueprint $table) {
            $table->bigInteger('agentsFulltextID', true);
            $table->integer('agentID');
            $table->text('biography')->nullable();
            $table->text('taxonomicGroups')->nullable();
            $table->text('collectionsAt')->nullable();
            $table->text('notes')->nullable();
            $table->text('name')->nullable();

            $table->fullText(['biography', 'taxonomicGroups', 'collectionsAt', 'notes', 'name'], 'ft_collectorbio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentsfulltext');
    }
};
