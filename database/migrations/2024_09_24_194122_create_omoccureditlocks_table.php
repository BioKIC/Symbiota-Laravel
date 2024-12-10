<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccureditlocks', function (Blueprint $table) {
            $table->unsignedInteger('occid')->primary();
            $table->integer('uid');
            $table->integer('ts');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccureditlocks');
    }
};
