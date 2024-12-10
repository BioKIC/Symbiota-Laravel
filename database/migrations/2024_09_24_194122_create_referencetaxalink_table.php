<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referencetaxalink', function (Blueprint $table) {
            $table->integer('refid')->index('fk_reftaxalink_refid_idx');
            $table->unsignedInteger('tid')->index('fk_reftaxalink_tid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['refid', 'tid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referencetaxalink');
    }
};
