<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurrevisions', function (Blueprint $table) {
            $table->integer('orid', true);
            $table->unsignedInteger('occid')->index('fk_omrevisions_occid_idx');
            $table->text('oldValues')->nullable();
            $table->text('newValues')->nullable();
            $table->string('externalSource', 45)->nullable()->index('index_omrevisions_source');
            $table->string('externalEditor', 100)->nullable()->index('index_omrevisions_editor');
            $table->string('guid', 45)->nullable()->unique('guid_unique');
            $table->integer('reviewStatus')->nullable()->index('index_omrevisions_reviewed');
            $table->integer('appliedStatus')->nullable()->index('index_omrevisions_applied');
            $table->string('errorMessage', 500)->nullable();
            $table->unsignedInteger('uid')->nullable()->index('fk_omrevisions_uid_idx');
            $table->dateTime('externalTimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurrevisions');
    }
};
