<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurdatasetlink', function (Blueprint $table) {
            $table->unsignedInteger('occid')->index('fk_omoccurdatasetlink_occid');
            $table->unsignedInteger('datasetid')->index('fk_omoccurdatasetlink_datasetid');
            $table->string('notes', 250)->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->primary(['occid', 'datasetid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurdatasetlink');
    }
};
