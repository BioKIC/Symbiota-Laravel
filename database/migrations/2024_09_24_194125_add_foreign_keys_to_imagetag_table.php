<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('imagetag', function (Blueprint $table) {
            $table->foreign(['keyvalue'], 'FK_imagetag_tagkey')->references(['tagkey'])->on('imagetagkey')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['imgid'], 'imagetag_ibfk_1')->references(['media_id'])->on('media')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('imagetag', function (Blueprint $table) {
            $table->dropForeign('FK_imagetag_tagkey');
            $table->dropForeign('imagetag_ibfk_1');
        });
    }
};
