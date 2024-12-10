<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('guidoccurdeterminations', function (Blueprint $table) {
            $table->string('guid', 45)->primary();
            $table->unsignedInteger('detid')->nullable()->unique('guidoccurdet_detid_unique');
            $table->integer('archivestatus')->default(0);
            $table->text('archiveobj')->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('guidoccurdeterminations');
    }
};
