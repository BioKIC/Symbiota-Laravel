<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('actionrequest', function (Blueprint $table) {
            $table->foreign(['requesttype'], 'FK_actionreq_type')->references(['requesttype'])->on('actionrequesttype')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid_requestor'], 'FK_actionreq_uid1')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid_fullfillor'], 'FK_actionreq_uid2')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('actionrequest', function (Blueprint $table) {
            $table->dropForeign('FK_actionreq_type');
            $table->dropForeign('FK_actionreq_uid1');
            $table->dropForeign('FK_actionreq_uid2');
        });
    }
};
