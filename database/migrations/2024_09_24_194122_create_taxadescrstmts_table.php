<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxadescrstmts', function (Blueprint $table) {
            $table->increments('tdsid');
            $table->unsignedInteger('tdbid')->index('fk_taxadescrstmts_tblock');
            $table->string('heading', 75)->nullable();
            $table->text('statement');
            $table->unsignedInteger('displayheader')->default(1);
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('sortsequence')->default(89);
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxadescrstmts');
    }
};
