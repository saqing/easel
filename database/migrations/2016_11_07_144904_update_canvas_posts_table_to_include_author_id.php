<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateCanvasPostsTableToIncludeAuthorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->integer('user_id')->after('id')->unsigned()->index()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->dropColumn('user_id');
        });
    }
}
