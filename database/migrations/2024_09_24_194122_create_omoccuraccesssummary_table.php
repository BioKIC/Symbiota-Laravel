<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccuraccesssummary', function (Blueprint $table) {
            $table->bigIncrements('oasid');
            $table->string('ipaddress', 45);
            $table->date('accessDate');
            $table->unsignedInteger('cnt');
            $table->string('accessType', 45);
            $table->text('queryStr')->nullable();
            $table->text('userAgent')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['ipaddress', 'accessDate', 'accessType'], 'unique_occuraccess');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccuraccesssummary');
    }
};
