<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossarytaxalink', function (Blueprint $table) {
            $table->unsignedInteger('glossid');
            $table->unsignedInteger('tid')->index('glossarytaxalink_ibfk_1');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['glossid', 'tid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossarytaxalink');
    }
};
