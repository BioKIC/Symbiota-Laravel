<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurgeoindex', function (Blueprint $table) {
            $table->unsignedInteger('tid');
            $table->double('decimallatitude');
            $table->double('decimallongitude');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['tid', 'decimallatitude', 'decimallongitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurgeoindex');
    }
};
