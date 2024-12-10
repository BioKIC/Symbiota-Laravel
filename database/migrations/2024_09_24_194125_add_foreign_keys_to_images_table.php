<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('images', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_images_occ')->references(['occid'])->on('omoccurrences')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['photographerUid'], 'FK_photographeruid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['tid'], 'FK_taxaimagestid')->references(['TID'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('FK_images_occ');
            $table->dropForeign('FK_photographeruid');
            $table->dropForeign('FK_taxaimagestid');
        });
    }
};
