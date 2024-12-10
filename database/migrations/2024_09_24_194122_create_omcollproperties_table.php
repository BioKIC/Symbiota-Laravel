<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollproperties', function (Blueprint $table) {
            $table->increments('collPropID');
            $table->unsignedInteger('collid')->index('fk_omcollproperties_collid_idx');
            $table->string('propCategory', 45);
            $table->string('propTitle', 45);
            $table->longText('propJson')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_omcollproperties_uid_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollproperties');
    }
};
