<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omcollections', function (Blueprint $table) {
            $table->foreign(['iid'], 'FK_collid_iid')->references(['iid'])->on('institutions')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omcollections', function (Blueprint $table) {
            $table->dropForeign('FK_collid_iid');
        });
    }
};
