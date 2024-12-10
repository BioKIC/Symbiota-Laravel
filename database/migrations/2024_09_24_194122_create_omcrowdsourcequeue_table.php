<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcrowdsourcequeue', function (Blueprint $table) {
            $table->integer('idomcrowdsourcequeue', true);
            $table->integer('omcsid');
            $table->integer('csProjID')->nullable()->index('fk_omcrowdsourcequeue_csprojid_idx');
            $table->unsignedInteger('occid')->index('fk_omcrowdsourcequeue_occid');
            $table->integer('reviewstatus')->default(0)->comment('0=open,5=pending review, 10=closed');
            $table->unsignedInteger('uidprocessor')->nullable()->index('fk_omcrowdsourcequeue_uid');
            $table->integer('points')->nullable()->comment('0=fail, 1=minor edits, 2=no edits <default>, 3=excelled');
            $table->integer('isvolunteer')->default(1);
            $table->dateTime('dateProcessed')->nullable();
            $table->dateTime('dateReviewed')->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['occid'], 'index_omcrowdsource_occid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcrowdsourcequeue');
    }
};
