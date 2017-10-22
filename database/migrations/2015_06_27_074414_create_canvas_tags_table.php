<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanvasTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CanvasHelper::TABLES['tags'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->string('meta_description');
            $table->string('layout')->default(config('blog.tag_layout'));
            $table->boolean('reverse_direction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CanvasHelper::TABLES['tags']);
    }
}
