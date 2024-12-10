<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omexsiccatinumbers', function (Blueprint $table) {
            $table->increments('omenid');
            $table->string('exsnumber', 45);
            $table->unsignedInteger('ometid')->index('fk_exsiccatititlenumber');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['exsnumber', 'ometid'], 'index_omexsiccatinumbers_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omexsiccatinumbers');
    }
};
