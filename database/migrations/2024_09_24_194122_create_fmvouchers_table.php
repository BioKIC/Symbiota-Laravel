<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('fmvouchers', function (Blueprint $table) {
            $table->increments('voucherID');
            $table->unsignedInteger('clTaxaID')->index('fk_fmvouchers_tidclid_idx');
            $table->unsignedInteger('TID')->nullable();
            $table->unsignedInteger('CLID')->nullable();
            $table->unsignedInteger('occid')->index('fk_fmvouchers_occ_idx');
            $table->string('editornotes', 50)->nullable();
            $table->integer('preferredImage')->nullable()->default(0);
            $table->string('Notes', 250)->nullable();
            $table->timestamp('InitialTimeStamp')->useCurrent();

            $table->unique(['clTaxaID', 'occid'], 'uq_fmvouchers_cltaxaid_occid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('fmvouchers');
    }
};
