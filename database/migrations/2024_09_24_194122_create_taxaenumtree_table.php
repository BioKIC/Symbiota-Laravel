<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxaenumtree', function (Blueprint $table) {
            $table->unsignedInteger('tid')->index('fk_tet_taxa');
            $table->unsignedInteger('taxauthid')->index('fk_tet_taxauth');
            $table->unsignedInteger('parenttid')->index('fk_tet_taxa2');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['tid', 'taxauthid', 'parenttid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxaenumtree');
    }
};
