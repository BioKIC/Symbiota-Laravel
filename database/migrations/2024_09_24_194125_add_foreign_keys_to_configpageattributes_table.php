<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('configpageattributes', function (Blueprint $table) {
            $table->foreign(['configpageid'], 'FK_configpageattributes_id')->references(['configpageid'])->on('configpage')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('configpageattributes', function (Blueprint $table) {
            $table->dropForeign('FK_configpageattributes_id');
        });
    }
};
