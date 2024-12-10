<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('unknowncomments', function (Blueprint $table) {
            $table->increments('unkcomid');
            $table->unsignedInteger('unkid')->index('fk_unknowncomments');
            $table->string('comment', 500);
            $table->string('username', 45);
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('unknowncomments');
    }
};
