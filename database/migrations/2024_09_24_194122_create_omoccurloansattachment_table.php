<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurloansattachment', function (Blueprint $table) {
            $table->increments('attachmentid');
            $table->unsignedInteger('loanid')->nullable()->index('fk_occurloansattachment_loanid_idx');
            $table->unsignedInteger('exchangeid')->nullable()->index('fk_occurloansattachment_exchangeid_idx');
            $table->string('title', 80);
            $table->string('path');
            $table->string('filename');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurloansattachment');
    }
};
