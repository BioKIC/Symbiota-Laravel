<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollpublications', function (Blueprint $table) {
            $table->increments('pubid');
            $table->unsignedInteger('collid')->index('fk_adminpub_collid_idx');
            $table->string('targeturl', 250);
            $table->string('securityguid', 45);
            $table->string('criteriajson', 250)->nullable();
            $table->integer('includedeterminations')->nullable()->default(1);
            $table->integer('includeimages')->nullable()->default(1);
            $table->integer('autoupdate')->nullable()->default(0);
            $table->dateTime('lastdateupdate')->nullable();
            $table->integer('updateinterval')->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollpublications');
    }
};
