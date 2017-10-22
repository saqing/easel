<?php

namespace Canvas\Jobs;

use Carbon\Carbon;
use Canvas\Models\Tag;
use Canvas\Models\Post;
use Canvas\Models\Settings;
use Illuminate\Queue\SerializesModels;

/**
 * Class BlogIndexData.
 */
class BlogIndexData
{
    use SerializesModels;

    protected $tag;

    /**
     * Constructor.
     *
     * @param string|null $tag
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Execute the command.
     *
     * @return array
     */
    public function handle()
    {
        if ($this->tag) {
            return $this->tagIndexData($this->tag);
        }

        return $this->normalIndexData();
    }

    /**
     * Return data for a tag index page.
     *
     * @param string $tag
     * @return array
     */
    protected function tagIndexData($tag)
    {
        $tag = Tag::where('tag', $tag)->firstOrFail();

        $reverse_direction = (bool) $tag->reverse_direction;

        $posts = Post::where('published_at', '<=', Carbon::now())
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('id', '=', $tag->id);
            })
            ->where('is_published', 1)
            ->orderBy('published_at', $reverse_direction ? 'asc' : 'desc')
            ->simplePaginate(config('blog.posts_per_page'));

        $posts->addQuery('tag', $tag->tag);

        $page_image = $tag->page_image ?: config('blog.page_image');

        return [
            'title' => $tag->title,
            'subtitle' => $tag->subtitle,
            'posts' => $posts,
            'page_image' => $page_image,
            'tag' => $tag,
            'reverse_direction' => $reverse_direction,
            'meta_description' => $tag->meta_description ?: \
            Settings::where('setting_name', 'blog_description')->find(1),
        ];
    }

    /**
     * Return data for normal index page.
     *
     * @return array
     */
    protected function normalIndexData()
    {
        $posts = Post::with('tags')
            ->where('published_at', '<=', Carbon::now())
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->simplePaginate(config('blog.posts_per_page'));

        return [
            'title' => Settings::where('setting_name', 'blog_title')->find(1),
            'subtitle' => Settings::where('setting_name', 'blog_subtitle')->find(1),
            'posts' => $posts,
            'page_image' => config('blog.page_image'),
            'meta_description' => Settings::where('setting_name', 'blog_description')->find(1),
            'reverse_direction' => false,
            'tag' => null,
        ];
    }
}
