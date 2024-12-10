<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('useraccesstokens', function (Blueprint $table) {
            $table->integer('tokenID', true);
            $table->unsignedInteger('uid')->index('fk_useraccesstokens_uid_idx');
            $table->string('token', 50);
            $table->string('device', 50)->nullable();
            $table->dateTime('experationDate')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('useraccesstokens');
    }
};
