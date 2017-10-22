<?php

use Canvas\Models\Post;
use Illuminate\Database\Migrations\Migration;

class UpdateCanvasPostsRenameIsDraftColumnToIsPublished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->is_draft === 0) {
                $post->is_draft = 1;
                $post->save();
            } elseif ($post->is_draft === 1) {
                $post->is_draft = 0;
                $post->save();
            }
        }
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->renameColumn('is_draft', 'is_published');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->is_published === 1) {
                $post->is_published = 0;
                $post->save();
            } elseif ($post->is_published === 0) {
                $post->is_published = 1;
                $post->save();
            }
        }
        Schema::table(CanvasHelper::TABLES['posts'], function ($table) {
            $table->renameColumn('is_published', 'is_draft');
        });
    }
}
