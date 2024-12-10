<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('firstName', 45)->nullable();
            $table->string('lastName', 45);
            $table->string('title', 150)->nullable();
            $table->string('institution', 200)->nullable();
            $table->string('department', 200)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip', 15)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('phone', 45)->nullable();
            $table->string('email', 100);
            $table->string('regionOfInterest', 45)->nullable();
            $table->string('url', 400)->nullable();
            $table->string('notes')->nullable();
            $table->string('rightsHolder', 250)->nullable();
            $table->string('rights', 250)->nullable();
            $table->string('accessrRights', 250)->nullable();
            $table->string('guid', 45)->nullable();
            $table->string('username', 45)->nullable()->unique('uq_users_username');
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('lastLoginDate')->nullable();
            $table->dateTime('loginModified')->nullable();
            $table->integer('validated')->default(0);
            $table->text('dynamicProperties')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
            $table->string('old_password', 45)->nullable();
            $table->string('name')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index(['lastName', 'email'], 'ix_users_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
