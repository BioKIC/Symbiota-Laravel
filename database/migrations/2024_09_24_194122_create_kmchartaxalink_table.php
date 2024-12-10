<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmchartaxalink', function (Blueprint $table) {
            $table->unsignedInteger('CID')->default(0);
            $table->unsignedInteger('TID')->default(0)->index('fk_chartaxalink-tid');
            $table->string('Status', 50)->nullable();
            $table->string('Notes')->nullable();
            $table->string('Relation', 45)->default('include');
            $table->boolean('EditabilityInherited')->nullable();
            $table->timestamp('timestamp')->useCurrent();

            $table->primary(['CID', 'TID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmchartaxalink');
    }
};
