<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imageprojectlink', function (Blueprint $table) {
            $table->unsignedInteger('imgid');
            $table->integer('imgprojid')->index('fk_imageprojlink_imgprojid_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['imgid', 'imgprojid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imageprojectlink');
    }
};
