<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('portalindex', function (Blueprint $table) {
            $table->integer('portalID', true);
            $table->string('portalName', 150);
            $table->string('acronym', 45)->nullable();
            $table->string('portalDescription', 250)->nullable();
            $table->string('urlRoot', 150);
            $table->string('securityKey', 45)->nullable();
            $table->string('symbiotaVersion', 45)->nullable();
            $table->string('guid', 45)->nullable()->unique('uq_portalindex_guid');
            $table->string('manager', 45)->nullable();
            $table->string('managerEmail', 45)->nullable();
            $table->string('primaryLead', 45)->nullable();
            $table->string('primaryLeadEmail', 45)->nullable();
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('portalindex');
    }
};
