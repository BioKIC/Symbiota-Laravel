<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imagekeywords', function (Blueprint $table) {
            $table->integer('imgkeywordid', true);
            $table->unsignedInteger('imgid')->index('fk_imagekeywords_imgid_idx');
            $table->string('keyword', 45)->index('index_imagekeyword');
            $table->unsignedInteger('uidassignedby')->nullable()->index('fk_imagekeyword_uid_idx');
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imagekeywords');
    }
};
