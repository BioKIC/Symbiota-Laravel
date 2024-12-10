<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurloanslink', function (Blueprint $table) {
            $table->unsignedInteger('loanid')->index('fk_occurloanlink_loanid');
            $table->unsignedInteger('occid')->index('fk_occurloanlink_occid');
            $table->date('returndate')->nullable();
            $table->string('notes')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->primary(['loanid', 'occid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurloanslink');
    }
};
