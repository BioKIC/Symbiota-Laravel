<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tmtraitdependencies', function (Blueprint $table) {
            $table->unsignedInteger('traitid')->index('fk_tmdepend_traitid_idx');
            $table->unsignedInteger('parentstateid')->index('fk_tmdepend_stateid_idx');
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->primary(['traitid', 'parentstateid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tmtraitdependencies');
    }
};
