<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('uploadspecmap', function (Blueprint $table) {
            $table->increments('usmid');
            $table->unsignedInteger('uspid');
            $table->string('sourcefield', 45);
            $table->string('symbdatatype', 45)->default('string')->comment('string, numeric, datetime');
            $table->string('symbspecfield', 45);
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['uspid', 'symbspecfield', 'sourcefield'], 'index_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('uploadspecmap');
    }
};
