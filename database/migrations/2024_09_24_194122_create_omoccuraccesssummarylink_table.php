<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccuraccesssummarylink', function (Blueprint $table) {
            $table->unsignedBigInteger('oasid');
            $table->unsignedInteger('occid')->index('omoccuraccesssummarylink_occid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->primary(['oasid', 'occid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccuraccesssummarylink');
    }
};
