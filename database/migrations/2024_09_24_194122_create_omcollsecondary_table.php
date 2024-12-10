<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollsecondary', function (Blueprint $table) {
            $table->increments('ocsid');
            $table->unsignedInteger('collid')->index('fk_omcollsecondary_coll');
            $table->string('InstitutionCode', 45);
            $table->string('CollectionCode', 45)->nullable();
            $table->string('CollectionName', 150);
            $table->string('BriefDescription', 300)->nullable();
            $table->string('FullDescription', 1000)->nullable();
            $table->string('Homepage', 250)->nullable();
            $table->string('IndividualUrl', 500)->nullable();
            $table->string('Contact', 45)->nullable();
            $table->string('Email', 45)->nullable();
            $table->double('LatitudeDecimal')->nullable();
            $table->double('LongitudeDecimal')->nullable();
            $table->string('icon', 250)->nullable();
            $table->string('CollType', 45)->nullable();
            $table->unsignedInteger('SortSeq')->nullable();
            $table->timestamp('InitialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollsecondary');
    }
};
