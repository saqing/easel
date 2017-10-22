<?php

use Illuminate\Database\Migrations\Migration;

class UpdateCanvasSettingValueType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['settings'], function ($table) {
            $table->text('setting_value')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(CanvasHelper::TABLES['settings'], function ($table) {
            $table->string('setting_value')->change();
        });
    }
}
