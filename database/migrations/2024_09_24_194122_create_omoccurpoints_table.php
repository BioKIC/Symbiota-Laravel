<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurpoints', function (Blueprint $table) {
            $table->integer('geoID', true);
            $table->integer('occid')->unique('occid');
            $table->geometry('point');
            $table->geometry('errradiuspoly', 'polygon')->nullable();
            $table->geometry('footprintpoly', 'polygon')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->spatialIndex(['point'], 'point');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurpoints');
    }
};
