<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tmattributes', function (Blueprint $table) {
            $table->unsignedInteger('stateid')->index('fk_tmattr_stateid_idx');
            $table->unsignedInteger('occid')->index('fk_tmattr_occid_idx');
            $table->string('modifier', 100)->nullable();
            $table->double('xvalue')->nullable();
            $table->unsignedInteger('imgid')->nullable()->index('fk_tmattr_imgid_idx');
            $table->string('imagecoordinates', 45)->nullable();
            $table->string('source', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->tinyInteger('statuscode')->nullable();
            $table->unsignedInteger('modifieduid')->nullable()->index('fk_tmattr_uidmodified_idx');
            $table->dateTime('datelastmodified')->nullable();
            $table->unsignedInteger('createduid')->nullable()->index('fk_attr_uidcreate_idx');
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->primary(['stateid', 'occid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tmattributes');
    }
};
