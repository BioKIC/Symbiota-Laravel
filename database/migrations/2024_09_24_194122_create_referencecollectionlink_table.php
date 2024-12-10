<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referencecollectionlink', function (Blueprint $table) {
            $table->integer('refid');
            $table->unsignedInteger('collid')->index('fk_refcollectionlink_collid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['refid', 'collid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referencecollectionlink');
    }
};
