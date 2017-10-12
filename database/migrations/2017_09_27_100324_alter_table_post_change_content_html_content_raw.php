<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AlterTablePostChangeContentHtmlContentRaw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->longText('content_raw')->nullable()->change();
            $table->longText('content_html')->nullable()->change();
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
            $table->text('content_raw')->change();
            $table->text('content_html')->change();
        });
    }
}
