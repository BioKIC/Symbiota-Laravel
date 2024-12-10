<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('imagekeywords', function (Blueprint $table) {
            $table->foreign(['imgid'], 'FK_imagekeywords_imgid')->references(['imgid'])->on('images')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uidassignedby'], 'FK_imagekeyword_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('imagekeywords', function (Blueprint $table) {
            $table->dropForeign('FK_imagekeywords_imgid');
            $table->dropForeign('FK_imagekeyword_uid');
        });
    }
};
