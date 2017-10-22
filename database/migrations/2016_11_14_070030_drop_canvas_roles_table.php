<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCanvasRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop(CanvasHelper::TABLES['roles']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create(CanvasHelper::TABLES['roles'], function (Blueprint $table) {
            $table->integer('id')->index();
            $table->string('description');
        });
    }
}
