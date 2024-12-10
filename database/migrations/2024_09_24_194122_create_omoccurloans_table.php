<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurloans', function (Blueprint $table) {
            $table->increments('loanid');
            $table->string('loanIdentifierOwn', 30)->nullable();
            $table->string('loanIdentifierBorr', 30)->nullable();
            $table->unsignedInteger('collidOwn')->nullable()->index('fk_occurloans_owncoll');
            $table->unsignedInteger('collidBorr')->nullable()->index('fk_occurloans_borrcoll');
            $table->unsignedInteger('iidOwner')->nullable()->index('fk_occurloans_owninst');
            $table->unsignedInteger('iidBorrower')->nullable()->index('fk_occurloans_borrinst');
            $table->date('dateSent')->nullable();
            $table->date('dateSentReturn')->nullable();
            $table->string('receivedStatus', 250)->nullable();
            $table->integer('totalBoxes')->nullable();
            $table->integer('totalBoxesReturned')->nullable();
            $table->integer('numSpecimens')->nullable();
            $table->string('shippingMethod', 50)->nullable();
            $table->string('shippingMethodReturn', 50)->nullable();
            $table->date('dateDue')->nullable();
            $table->date('dateReceivedOwn')->nullable();
            $table->date('dateReceivedBorr')->nullable();
            $table->date('dateClosed')->nullable();
            $table->string('forWhom', 50)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('invoiceMessageOwn', 500)->nullable();
            $table->string('invoiceMessageBorr', 500)->nullable();
            $table->string('notes', 500)->nullable();
            $table->string('createdByOwn', 30)->nullable();
            $table->string('createdByBorr', 30)->nullable();
            $table->unsignedInteger('processingStatus')->nullable()->default(1);
            $table->string('processedByOwn', 30)->nullable();
            $table->string('processedByBorr', 30)->nullable();
            $table->string('processedByReturnOwn', 30)->nullable();
            $table->string('processedByReturnBorr', 30)->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurloans');
    }
};
