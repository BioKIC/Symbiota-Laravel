<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('access_token', 255)->nullable();
            $table->string('refresh_token', 255)->nullable();
            $table->enum('oauth_provider', ['orcid'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['access_token', 'refresh_token', 'oauth_provider']);
        });
    }
};
