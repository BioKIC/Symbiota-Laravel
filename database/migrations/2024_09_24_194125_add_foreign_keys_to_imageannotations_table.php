<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('imageannotations', function (Blueprint $table) {
            $table->foreign(['imgid'], 'FK_resourceannotations_imgid')->references(['imgid'])->on('images')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['tid'], 'FK_resourceannotations_tid')->references(['TID'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('imageannotations', function (Blueprint $table) {
            $table->dropForeign('FK_resourceannotations_imgid');
            $table->dropForeign('FK_resourceannotations_tid');
        });
    }
};
