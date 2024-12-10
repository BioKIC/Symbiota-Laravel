<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurdatasets', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_omcollections_collid')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['parentDatasetID'], 'FK_omoccurdatasets_parent')->references(['datasetID'])->on('omoccurdatasets')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['uid'], 'FK_omoccurdatasets_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurdatasets', function (Blueprint $table) {
            $table->dropForeign('FK_omcollections_collid');
            $table->dropForeign('FK_omoccurdatasets_parent');
            $table->dropForeign('FK_omoccurdatasets_uid');
        });
    }
};
