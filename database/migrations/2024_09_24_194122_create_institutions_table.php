<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('iid');
            $table->string('institutionID', 45)->nullable();
            $table->string('InstitutionCode', 45);
            $table->string('InstitutionName', 150);
            $table->string('InstitutionName2')->nullable();
            $table->string('Address1', 150)->nullable();
            $table->string('Address2', 150)->nullable();
            $table->string('City', 45)->nullable();
            $table->string('StateProvince', 45)->nullable();
            $table->string('PostalCode', 45)->nullable();
            $table->string('Country', 45)->nullable();
            $table->string('Phone', 100)->nullable();
            $table->string('Contact')->nullable();
            $table->string('Email')->nullable();
            $table->string('Url', 250)->nullable();
            $table->text('Notes')->nullable();
            $table->unsignedInteger('modifieduid')->nullable()->index('fk_inst_uid_idx');
            $table->dateTime('modifiedTimeStamp')->nullable();
            $table->timestamp('IntialTimeStamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('institutions');
    }
};
