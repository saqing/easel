<?php

use Illuminate\Database\Migrations\Migration;

class AddCvColumnToCanvasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['users'], function ($table) {
            $table->string('resume_cv')->after('linkedin')->nullable();
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
            $table->dropColumn('resume_cv');
        });
    }
}
