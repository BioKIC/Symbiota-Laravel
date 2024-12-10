<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollcatlink', function (Blueprint $table) {
            $table->unsignedInteger('ccpk');
            $table->unsignedInteger('collid')->index('fk_collcatlink_coll');
            $table->boolean('isPrimary')->nullable()->default(true);
            $table->integer('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['ccpk', 'collid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollcatlink');
    }
};
