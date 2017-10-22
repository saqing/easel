<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddRolesColumnToCanvasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['users'], function ($table) {
            $table->integer('role')->after('display_name')->nullable();
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
            $table->dropColumn('role');
        });
    }
}
