<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('userroles', function (Blueprint $table) {
            $table->increments('userRoleID');
            $table->unsignedInteger('uid')->index('fk_userroles_uid_idx');
            $table->string('role', 45);
            $table->string('tableName', 45)->nullable();
            $table->integer('tablePK')->nullable();
            $table->string('secondaryVariable', 45)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('uidAssignedBy')->nullable()->index('fk_usrroles_uid2_idx');
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->index(['tableName', 'tablePK'], 'index_userroles_table');
            $table->unique(['uid', 'role', 'tableName', 'tablePK'], 'unique_userroles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('userroles');
    }
};
