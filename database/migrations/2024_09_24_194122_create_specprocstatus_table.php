<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocstatus', function (Blueprint $table) {
            $table->increments('spsID');
            $table->unsignedInteger('occid')->index('specprocstatus_occid_idx');
            $table->string('processName', 45);
            $table->string('result', 45)->nullable();
            $table->string('processVariables', 150);
            $table->unsignedInteger('processorUid')->nullable()->index('specprocstatus_uid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocstatus');
    }
};
