<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('referencechklsttaxalink', function (Blueprint $table) {
            $table->integer('refid');
            $table->unsignedInteger('clid');
            $table->unsignedInteger('tid');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->index(['clid', 'tid'], 'fk_refchktaxalink_clidtid_idx');
            $table->primary(['refid', 'clid', 'tid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('referencechklsttaxalink');
    }
};
