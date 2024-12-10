<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccuraccesslink', function (Blueprint $table) {
            $table->unsignedBigInteger('occurAccessID');
            $table->unsignedInteger('occid');
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->primary(['occurAccessID', 'occid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccuraccesslink');
    }
};
