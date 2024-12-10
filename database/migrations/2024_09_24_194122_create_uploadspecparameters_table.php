<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('uploadspecparameters', function (Blueprint $table) {
            $table->increments('uspid');
            $table->unsignedInteger('collid')->index('fk_uploadspecparameters_coll');
            $table->unsignedInteger('uploadType')->default(1)->comment('1 = Direct; 2 = DiGIR; 3 = File');
            $table->string('title', 45);
            $table->string('platform', 45)->nullable()->default('1')->comment('1 = MySQL; 2 = MSSQL; 3 = ORACLE; 11 = MS Access; 12 = FileMaker');
            $table->string('server', 150)->nullable();
            $table->unsignedInteger('port')->nullable();
            $table->string('driver', 45)->nullable();
            $table->string('code', 45)->nullable();
            $table->string('path', 500)->nullable();
            $table->string('pkField', 45)->nullable();
            $table->string('username', 45)->nullable();
            $table->string('password', 45)->nullable();
            $table->string('schemaName', 150)->nullable();
            $table->string('internalQuery', 250)->nullable();
            $table->text('queryStr')->nullable();
            $table->string('cleanupSP', 45)->nullable();
            $table->integer('endpointPublic')->nullable();
            $table->unsignedInteger('dlmisvalid')->nullable()->default(0);
            $table->unsignedInteger('createdUid')->nullable()->index('fk_uploadspecparameters_uid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('uploadspecparameters');
    }
};
