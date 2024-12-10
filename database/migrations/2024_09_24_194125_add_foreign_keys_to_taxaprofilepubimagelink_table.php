<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxaprofilepubimagelink', function (Blueprint $table) {
            $table->foreign(['tppid'], 'FK_tppubimagelink_id')->references(['tppid'])->on('taxaprofilepubs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['imgid'], 'FK_tppubimagelink_imgid')->references(['imgid'])->on('images')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxaprofilepubimagelink', function (Blueprint $table) {
            $table->dropForeign('FK_tppubimagelink_id');
            $table->dropForeign('FK_tppubimagelink_imgid');
        });
    }
};
