<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccuredits', function (Blueprint $table) {
            $table->integer('ocedid', true);
            $table->unsignedInteger('occid')->index('fk_omoccuredits_occid');
            $table->string('tableName', 45)->nullable()->index('fk_omoccuredits_tablename');
            $table->string('fieldName', 45)->index('fk_omoccuredits_fieldname');
            $table->text('fieldValueNew');
            $table->text('fieldValueOld');
            $table->integer('reviewStatus')->default(1)->index('fk_omoccuredits_reviewedstatus')->comment('1=Open;2=Pending;3=Closed');
            $table->integer('appliedStatus')->default(0)->index('fk_omoccuredits_appliedstatus')->comment('0=Not Applied;1=Applied');
            $table->integer('editType')->nullable()->default(0)->comment('0 = general edit, 1 = batch edit');
            $table->integer('isActive')->nullable()->comment('0 = not the value applied within the active field, 1 = valued applied within active field');
            $table->integer('reapply')->nullable()->comment('0 = do not reapply edit; 1 = reapply edit when snapshot is refreshed, if edit isActive and snapshot value still matches old value ');
            $table->string('guid', 45)->nullable()->unique('guid_unique');
            $table->unsignedInteger('uid')->index('fk_omoccuredits_uid');
            $table->timestamp('initialTimestamp')->useCurrent()->index('ix_omoccuredits_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccuredits');
    }
};
