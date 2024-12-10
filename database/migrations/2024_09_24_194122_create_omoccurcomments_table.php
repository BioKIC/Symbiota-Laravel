<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurcomments', function (Blueprint $table) {
            $table->integer('comid', true);
            $table->unsignedInteger('occid')->index('fk_omoccurcomments_occid');
            $table->text('comment');
            $table->unsignedInteger('uid')->index('fk_omoccurcomments_uid');
            $table->unsignedInteger('reviewstatus')->default(0);
            $table->unsignedInteger('parentcomid')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurcomments');
    }
};
