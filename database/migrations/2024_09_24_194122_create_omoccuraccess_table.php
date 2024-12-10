<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccuraccess', function (Blueprint $table) {
            $table->bigIncrements('occurAccessID');
            $table->string('ipaddress', 45);
            $table->string('accessType', 45);
            $table->text('queryStr')->nullable();
            $table->text('userAgent')->nullable();
            $table->string('frontendGuid', 45)->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccuraccess');
    }
};
