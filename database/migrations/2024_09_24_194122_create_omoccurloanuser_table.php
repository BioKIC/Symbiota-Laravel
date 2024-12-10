<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurloanuser', function (Blueprint $table) {
            $table->unsignedInteger('loanid');
            $table->unsignedInteger('uid')->index('fk_occurloan_uid_idx');
            $table->string('accessType', 45);
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedByUid')->nullable()->index('fk_occurloan_modifiedbyuid_idx');
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->primary(['loanid', 'uid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurloanuser');
    }
};
