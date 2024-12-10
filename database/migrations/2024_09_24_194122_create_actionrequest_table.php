<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('actionrequest', function (Blueprint $table) {
            $table->bigInteger('actionrequestid', true);
            $table->integer('fk');
            $table->string('tablename')->nullable();
            $table->string('requesttype', 30)->index('fk_actionreq_type_idx');
            $table->unsignedInteger('uid_requestor')->index('fk_actionreq_uid1_idx');
            $table->timestamp('requestdate')->useCurrentOnUpdate()->useCurrent();
            $table->string('requestremarks', 900)->nullable();
            $table->integer('priority')->nullable();
            $table->unsignedInteger('uid_fullfillor')->index('fk_actionreq_uid2_idx');
            $table->string('state', 12)->nullable();
            $table->string('resolution', 12)->nullable();
            $table->dateTime('statesetdate')->nullable();
            $table->string('resolutionremarks', 900)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('actionrequest');
    }
};
