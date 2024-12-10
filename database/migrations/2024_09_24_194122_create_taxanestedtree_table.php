<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxanestedtree', function (Blueprint $table) {
            $table->unsignedInteger('tid')->index('fk_tnt_taxa');
            $table->unsignedInteger('taxauthid')->index('fk_tnt_taxauth');
            $table->unsignedInteger('leftindex')->index('leftindex');
            $table->unsignedInteger('rightindex')->index('rightindex');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['tid', 'taxauthid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxanestedtree');
    }
};
