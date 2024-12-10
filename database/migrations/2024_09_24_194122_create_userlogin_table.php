<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('userlogin', function (Blueprint $table) {
            $table->unsignedInteger('uid')->index('fk_login_user');
            $table->string('username', 45)->primary();
            $table->string('password', 45);
            $table->string('alias', 45)->nullable()->unique('index_userlogin_unique');
            $table->dateTime('lastlogindate')->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('userlogin');
    }
};
