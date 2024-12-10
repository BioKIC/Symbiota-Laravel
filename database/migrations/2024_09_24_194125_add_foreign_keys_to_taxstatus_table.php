<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxstatus', function (Blueprint $table) {
            $table->foreign(['parenttid'], 'FK_taxstatus_parent')->references(['tid'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['taxauthid'], 'FK_taxstatus_taid')->references(['taxauthid'])->on('taxauthority')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['tid'], 'FK_taxstatus_tid')->references(['tid'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['tidaccepted'], 'FK_taxstatus_tidacc')->references(['tid'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['modifiedUid'], 'FK_taxstatus_uid')->references(['uid'])->on('users')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxstatus', function (Blueprint $table) {
            $table->dropForeign('FK_taxstatus_parent');
            $table->dropForeign('FK_taxstatus_taid');
            $table->dropForeign('FK_taxstatus_tid');
            $table->dropForeign('FK_taxstatus_tidacc');
            $table->dropForeign('FK_taxstatus_uid');
        });
    }
};
