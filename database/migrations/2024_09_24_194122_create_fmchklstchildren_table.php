<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmchklstchildren', function (Blueprint $table) {
            $table->unsignedInteger('clid')->index('fk_fmchklstchild_clid_idx');
            $table->unsignedInteger('clidchild')->index('fk_fmchklstchild_child_idx');
            $table->unsignedInteger('modifiedUid');
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['clid', 'clidchild']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmchklstchildren');
    }
};
