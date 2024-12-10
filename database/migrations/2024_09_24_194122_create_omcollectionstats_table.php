<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollectionstats', function (Blueprint $table) {
            $table->unsignedInteger('collid')->primary();
            $table->unsignedInteger('recordcnt')->default(0);
            $table->unsignedInteger('georefcnt')->nullable();
            $table->unsignedInteger('familycnt')->nullable();
            $table->unsignedInteger('genuscnt')->nullable();
            $table->unsignedInteger('speciescnt')->nullable();
            $table->dateTime('uploaddate')->nullable();
            $table->dateTime('datelastmodified')->nullable();
            $table->string('uploadedby', 45)->nullable();
            $table->longText('dynamicProperties')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollectionstats');
    }
};
