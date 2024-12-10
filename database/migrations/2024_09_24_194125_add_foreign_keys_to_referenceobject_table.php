<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referenceobject', function (Blueprint $table) {
            $table->foreign(['parentRefId'], 'FK_refobj_parentrefid')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['ReferenceTypeId'], 'FK_refobj_reftypeid')->references(['ReferenceTypeId'])->on('referencetype')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referenceobject', function (Blueprint $table) {
            $table->dropForeign('FK_refobj_parentrefid');
            $table->dropForeign('FK_refobj_reftypeid');
        });
    }
};
