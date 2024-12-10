<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurdatasetlink', function (Blueprint $table) {
            $table->foreign(['datasetid'], 'FK_omoccurdatasetlink_datasetid')->references(['datasetid'])->on('omoccurdatasets')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['occid'], 'FK_omoccurdatasetlink_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurdatasetlink', function (Blueprint $table) {
            $table->dropForeign('FK_omoccurdatasetlink_datasetid');
            $table->dropForeign('FK_omoccurdatasetlink_occid');
        });
    }
};
