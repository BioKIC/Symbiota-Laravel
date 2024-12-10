<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigInteger('agentID', true);
            $table->string('familyName', 45)->index('ix_agents_familyname');
            $table->string('firstName', 45)->nullable()->index('ix_agents_firstname');
            $table->string('middleName', 45)->nullable();
            $table->integer('startYearActive')->nullable();
            $table->integer('endYearActive')->nullable();
            $table->string('notes')->nullable();
            $table->integer('rating')->nullable()->default(10);
            $table->string('guid', 900)->nullable()->unique('uq_agents_guid');
            $table->bigInteger('preferredRecByID')->nullable()->index('fk_agents_preferred_recby_idx');
            $table->text('biography')->nullable();
            $table->string('taxonomicGroups', 900)->nullable();
            $table->string('collectionsAt', 900)->nullable();
            $table->boolean('curated')->nullable()->default(false);
            $table->boolean('nototherwisespecified')->nullable()->default(false);
            $table->enum('type', ['Individual', 'Team', 'Organization'])->nullable();
            $table->string('prefix', 32)->nullable();
            $table->string('suffix', 32)->nullable();
            $table->text('nameString')->nullable();
            $table->char('mboxSha1Sum', 40)->nullable();
            $table->integer('yearOfBirth')->nullable();
            $table->string('yearOfBirthModifier', 12)->nullable()->default('');
            $table->integer('yearOfDeath')->nullable();
            $table->string('yearOfDeathModifier', 12)->nullable()->default('');
            $table->enum('living', ['Y', 'N', '?'])->default('?');
            $table->char('recordID', 43)->nullable();
            $table->dateTime('dateLastModified')->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_agents_moduid_idx');
            $table->unsignedInteger('createdUid')->nullable()->index('fk_agents_createduid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agents');
    }
};
