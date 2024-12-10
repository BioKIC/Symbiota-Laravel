<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmchklstchildren', function (Blueprint $table) {
            $table->foreign(['clidchild'], 'FK_fmchklstchild_child')->references(['clid'])->on('fmchecklists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['clid'], 'FK_fmchklstchild_clid')->references(['clid'])->on('fmchecklists')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmchklstchildren', function (Blueprint $table) {
            $table->dropForeign('FK_fmchklstchild_child');
            $table->dropForeign('FK_fmchklstchild_clid');
        });
    }
};
