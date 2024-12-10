<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('unknowns', function (Blueprint $table) {
            $table->increments('unkid');
            $table->unsignedInteger('tid')->nullable()->index('fk_unknowns_tid');
            $table->string('photographer', 100)->nullable();
            $table->string('owner', 100)->nullable();
            $table->string('locality', 250)->nullable();
            $table->double('latdecimal')->nullable();
            $table->double('longdecimal')->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('username', 45)->index('fk_unknowns_username');
            $table->string('idstatus', 45)->default('ID pending');
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('unknowns');
    }
};
