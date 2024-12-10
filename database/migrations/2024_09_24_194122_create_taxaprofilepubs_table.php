<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxaprofilepubs', function (Blueprint $table) {
            $table->integer('tppid', true);
            $table->string('pubtitle', 150)->index('index_taxaprofilepubs_title');
            $table->string('authors', 150)->nullable();
            $table->string('description', 500)->nullable();
            $table->text('abstract')->nullable();
            $table->unsignedInteger('uidowner')->nullable()->index('fk_taxaprofilepubs_uid_idx');
            $table->string('externalurl', 250)->nullable();
            $table->string('rights', 250)->nullable();
            $table->string('usageterm', 250)->nullable();
            $table->string('accessrights', 250)->nullable();
            $table->integer('ispublic')->nullable();
            $table->integer('inclusive')->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxaprofilepubs');
    }
};
