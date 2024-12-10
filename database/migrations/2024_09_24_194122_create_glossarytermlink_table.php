<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('glossarytermlink', function (Blueprint $table) {
            $table->integer('gltlinkid', true);
            $table->unsignedInteger('glossgrpid');
            $table->unsignedInteger('glossid')->index('glossarytermlink_ibfk_1');
            $table->string('relationshipType', 45)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['glossgrpid', 'glossid'], 'unique_termkeys');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('glossarytermlink');
    }
};
