<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('portalpublications', function (Blueprint $table) {
            $table->increments('pubid');
            $table->string('pubTitle', 45);
            $table->string('description', 250)->nullable();
            $table->string('guid', 45)->nullable()->unique('uq_portalpub_guid');
            $table->unsignedInteger('collid')->nullable()->index('fk_portalpub_collid_idx');
            $table->integer('portalID')->index('fk_portalpub_portalid_idx');
            $table->string('direction', 45);
            $table->text('criteriaJson')->nullable();
            $table->integer('includeDeterminations')->nullable()->default(1);
            $table->integer('includeImages')->nullable()->default(1);
            $table->integer('autoUpdate')->nullable()->default(0);
            $table->dateTime('lastDateUpdate')->nullable();
            $table->integer('updateInterval')->nullable();
            $table->unsignedInteger('createdUid')->nullable()->index('fk_portalpub_uid_idx');
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('portalpublications');
    }
};
