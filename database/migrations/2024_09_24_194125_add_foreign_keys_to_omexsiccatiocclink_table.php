<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('omexsiccatiocclink', function (Blueprint $table) {
            $table->foreign(['omenid'], 'FKExsiccatiNumOccLink1')->references(['omenid'])->on('omexsiccatinumbers')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['occid'], 'FKExsiccatiNumOccLink2')->references(['occid'])->on('omoccurrences')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('omexsiccatiocclink', function (Blueprint $table) {
            $table->dropForeign('FKExsiccatiNumOccLink1');
            $table->dropForeign('FKExsiccatiNumOccLink2');
        });
    }
};