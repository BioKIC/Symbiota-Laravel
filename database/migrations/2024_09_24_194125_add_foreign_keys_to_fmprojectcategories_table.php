<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmprojectcategories', function (Blueprint $table) {
            $table->foreign(['pid'], 'FK_fmprojcat_pid')->references(['pid'])->on('fmprojects')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmprojectcategories', function (Blueprint $table) {
            $table->dropForeign('FK_fmprojcat_pid');
        });
    }
};
