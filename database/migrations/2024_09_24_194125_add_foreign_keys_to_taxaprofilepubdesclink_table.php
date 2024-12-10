<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxaprofilepubdesclink', function (Blueprint $table) {
            $table->foreign(['tppid'], 'FK_tppubdesclink_id')->references(['tppid'])->on('taxaprofilepubs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tdbid'], 'FK_tppubdesclink_tdbid')->references(['tdbid'])->on('taxadescrblock')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxaprofilepubdesclink', function (Blueprint $table) {
            $table->dropForeign('FK_tppubdesclink_id');
            $table->dropForeign('FK_tppubdesclink_tdbid');
        });
    }
};
