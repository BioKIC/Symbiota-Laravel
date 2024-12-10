<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmchardependance', function (Blueprint $table) {
            $table->unsignedInteger('CID')->index('fk_chardependance_cid_idx');
            $table->unsignedInteger('CIDDependance');
            $table->string('CSDependance', 16);
            $table->timestamp('InitialTimeStamp')->useCurrent();

            $table->index(['CIDDependance', 'CSDependance'], 'fk_chardependance_cs_idx');
            $table->primary(['CSDependance', 'CIDDependance', 'CID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmchardependance');
    }
};
