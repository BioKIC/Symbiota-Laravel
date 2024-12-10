<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollpuboccurlink', function (Blueprint $table) {
            $table->unsignedInteger('pubid');
            $table->unsignedInteger('occid')->index('fk_ompuboccid_idx');
            $table->integer('verification')->default(0);
            $table->dateTime('refreshtimestamp');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['pubid', 'occid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollpuboccurlink');
    }
};
