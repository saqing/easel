<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanvasPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CanvasHelper::TABLES['posts'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->text('content_raw');
            $table->text('content_html');
            $table->string('page_image')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->string('layout')->default(config('blog.post_layout'));
            $table->timestamps();
            $table->timestamp('published_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CanvasHelper::TABLES['posts']);
    }
}
