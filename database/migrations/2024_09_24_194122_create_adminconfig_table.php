<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('adminconfig', function (Blueprint $table) {
            $table->integer('configID', true);
            $table->string('category', 45)->nullable();
            $table->string('attributeName', 45)->unique('uq_adminconfig_name');
            $table->string('attributeValue', 1000);
            $table->text('dynamicProperties')->nullable();
            $table->string('notes', 45)->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_adminconfig_uid_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('adminconfig');
    }
};
