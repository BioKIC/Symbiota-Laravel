<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxavernaculars', function (Blueprint $table) {
            $table->unsignedInteger('TID')->default(0)->index('tid1');
            $table->string('VernacularName', 80)->index('vernacularsnames');
            $table->string('Language', 15)->nullable();
            $table->integer('langid')->nullable()->index('fk_vern_lang_idx');
            $table->string('Source', 50)->nullable();
            $table->string('notes', 250)->nullable();
            $table->string('username', 45)->nullable();
            $table->integer('isupperterm')->nullable()->default(0);
            $table->integer('SortSequence')->nullable()->default(50);
            $table->integer('VID', true);
            $table->timestamp('InitialTimeStamp')->useCurrent();

            $table->unique(['VernacularName', 'TID', 'langid'], 'unique-key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxavernaculars');
    }
};
