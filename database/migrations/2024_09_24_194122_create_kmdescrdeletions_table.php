<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmdescrdeletions', function (Blueprint $table) {
            $table->unsignedInteger('TID');
            $table->unsignedInteger('CID');
            $table->string('CS', 16);
            $table->string('Modifier')->nullable();
            $table->double('X')->nullable();
            $table->longText('TXT')->nullable();
            $table->string('Inherited', 50)->nullable();
            $table->string('Source', 100)->nullable();
            $table->unsignedInteger('Seq')->nullable();
            $table->longText('Notes')->nullable();
            $table->dateTime('InitialTimeStamp')->nullable();
            $table->string('DeletedBy', 100);
            $table->timestamp('DeletedTimeStamp')->useCurrent();
            $table->increments('PK');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmdescrdeletions');
    }
};
