<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('institutions', function (Blueprint $table) {
            $table->foreign(['modifieduid'], 'FK_inst_uid')->references(['uid'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropForeign('FK_inst_uid');
        });
    }
};
