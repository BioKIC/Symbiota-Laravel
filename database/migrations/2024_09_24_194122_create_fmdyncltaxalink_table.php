<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmdyncltaxalink', function (Blueprint $table) {
            $table->unsignedInteger('dynclid');
            $table->unsignedInteger('tid')->index('fk_dyncltaxalink_taxa');
            $table->timestamp('initialtimestamp')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['dynclid', 'tid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmdyncltaxalink');
    }
};
