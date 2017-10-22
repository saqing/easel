<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanvasSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CanvasHelper::TABLES['settings'], function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('setting_name')->index();
            $table->string('setting_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(CanvasHelper::TABLES['settings']);
    }
}
