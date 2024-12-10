<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('adminstats', function (Blueprint $table) {
            $table->increments('idadminstats');
            $table->string('category', 45)->index('index_category');
            $table->string('statname', 45);
            $table->integer('statvalue')->nullable();
            $table->integer('statpercentage')->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->integer('groupid');
            $table->unsignedInteger('collid')->nullable()->index('fk_adminstats_collid_idx');
            $table->unsignedInteger('uid')->nullable()->index('fk_adminstats_uid_idx');
            $table->string('note', 250)->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent()->index('index_adminstats_ts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('adminstats');
    }
};
