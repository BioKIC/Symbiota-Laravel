<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcharheadinglang', function (Blueprint $table) {
            $table->foreign(['hid'], 'FK_kmcharheadinglang_hid')->references(['hid'])->on('kmcharheading')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['langid'], 'FK_kmcharheadinglang_langid')->references(['langid'])->on('adminlanguages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcharheadinglang', function (Blueprint $table) {
            $table->dropForeign('FK_kmcharheadinglang_hid');
            $table->dropForeign('FK_kmcharheadinglang_langid');
        });
    }
};
