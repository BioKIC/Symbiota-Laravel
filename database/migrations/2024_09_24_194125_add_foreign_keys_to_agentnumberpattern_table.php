<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentnumberpattern', function (Blueprint $table) {
            $table->foreign(['agentID'], 'agentnumberpattern_ibfk_1')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentnumberpattern', function (Blueprint $table) {
            $table->dropForeign('agentnumberpattern_ibfk_1');
        });
    }
};
