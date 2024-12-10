<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('kmdescr', function (Blueprint $table) {
            $table->unsignedInteger('TID')->default(0);
            $table->unsignedInteger('CID')->default(0);
            $table->string('Modifier')->nullable();
            $table->string('CS', 16);
            $table->double('X')->nullable();
            $table->longText('TXT')->nullable();
            $table->unsignedInteger('PseudoTrait')->nullable()->default(0);
            $table->unsignedInteger('Frequency')->default(5)->comment('Frequency of occurrence; 1 = rare... 5 = common');
            $table->string('Inherited', 50)->nullable();
            $table->string('Source', 100)->nullable();
            $table->integer('Seq')->nullable();
            $table->longText('Notes')->nullable();
            $table->timestamp('DateEntered')->useCurrent();

            $table->index(['CID', 'CS'], 'csdescr');
            $table->primary(['TID', 'CID', 'CS']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kmdescr');
    }
};
