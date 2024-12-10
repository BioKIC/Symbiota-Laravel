<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurexchange', function (Blueprint $table) {
            $table->increments('exchangeid');
            $table->string('identifier', 30)->nullable();
            $table->unsignedInteger('collid')->nullable()->index('fk_occexch_coll');
            $table->unsignedInteger('iid')->nullable();
            $table->string('transactionType', 10)->nullable();
            $table->string('in_out', 3)->nullable();
            $table->date('dateSent')->nullable();
            $table->date('dateReceived')->nullable();
            $table->integer('totalBoxes')->nullable();
            $table->string('shippingMethod', 50)->nullable();
            $table->integer('totalExMounted')->nullable();
            $table->integer('totalExUnmounted')->nullable();
            $table->integer('totalGift')->nullable();
            $table->integer('totalGiftDet')->nullable();
            $table->integer('adjustment')->nullable();
            $table->integer('invoiceBalance')->nullable();
            $table->string('invoiceMessage', 500)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('notes', 500)->nullable();
            $table->string('createdBy', 20)->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurexchange');
    }
};
