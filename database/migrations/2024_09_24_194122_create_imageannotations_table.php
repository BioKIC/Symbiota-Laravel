<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('imageannotations', function (Blueprint $table) {
            $table->unsignedInteger('tid')->nullable()->index('tid');
            $table->unsignedInteger('imgid')->default(0);
            $table->dateTime('AnnDate')->useCurrent();
            $table->string('Annotator', 100)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['imgid', 'AnnDate']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('imageannotations');
    }
};
