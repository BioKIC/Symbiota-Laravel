<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taxstatus', function (Blueprint $table) {
            $table->unsignedInteger('tid')->index('index_tid');
            $table->unsignedInteger('tidaccepted')->index('fk_taxstatus_tidacc');
            $table->unsignedInteger('taxauthid')->index('fk_taxstatus_taid')->comment('taxon authority id');
            $table->unsignedInteger('parenttid')->nullable()->index('index_parenttid');
            $table->string('family', 50)->nullable()->index('index_ts_family');
            $table->string('taxonomicStatus', 45)->nullable();
            $table->string('taxonomicSource', 500)->nullable();
            $table->string('sourceIdentifier', 150)->nullable();
            $table->string('UnacceptabilityReason', 250)->nullable();
            $table->string('notes', 250)->nullable();
            $table->unsignedInteger('SortSequence')->nullable()->default(50);
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_taxstatus_uid_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->timestamp('initialtimestamp')->useCurrentOnUpdate()->useCurrent();

            $table->primary(['tid', 'tidaccepted', 'taxauthid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taxstatus');
    }
};
