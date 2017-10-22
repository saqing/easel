<?php

use Illuminate\Database\Migrations\Migration;

class AddLinkedinColumnToCanvasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['users'], function ($table) {
            $table->string('linkedin')->after('github')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(CanvasHelper::TABLES['users'], function ($table) {
            $table->dropColumn('linkedin');
        });
    }
}
