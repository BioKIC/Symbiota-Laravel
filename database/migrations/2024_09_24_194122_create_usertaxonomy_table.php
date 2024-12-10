<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('usertaxonomy', function (Blueprint $table) {
            $table->integer('idusertaxonomy', true);
            $table->unsignedInteger('uid')->index('fk_usertaxonomy_uid_idx');
            $table->unsignedInteger('tid')->index('fk_usertaxonomy_tid_idx');
            $table->unsignedInteger('taxauthid')->default(1)->index('fk_usertaxonomy_taxauthid_idx');
            $table->string('editorstatus', 45)->nullable();
            $table->string('geographicScope', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('modifiedUid');
            $table->dateTime('modifiedtimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['uid', 'tid', 'taxauthid', 'editorstatus'], 'usertaxonomy_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('usertaxonomy');
    }
};
