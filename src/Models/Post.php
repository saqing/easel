<?php

namespace Canvas\Models;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Canvas\Helpers\CanvasHelper;
use Canvas\Services\Parsedowner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use Searchable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'canvas_posts';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'subtitle',
        'content_raw',
        'page_image',
        'meta_description',
        'is_published',
        'layout',
        'published_at',
    ];

    /**
     * Searchable items.
     *
     * @var array
     */
    public $searchable = [
        'title',
        'subtitle',
        'content_raw',
        'meta_description',
    ];

    /**
     * Get the tags relationship.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, CanvasHelper::TABLES['post_tag'])->withTimestamps();
    }

    /**
     * Get the user relationship.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set the HTML content automatically when the raw content is set.
     *
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Parsedowner();
        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    /**
     * Sync tag relationships and add new tags as needed.
     *
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        Tag::addNeededTags($tags);
        if (count($tags)) {
            $this->tags()->sync(
                Tag::whereIn('tag', $tags)->pluck('id')->all()
            );

            return;
        }
        $this->tags()->detach();
    }

    /**
     * Get the raw content attribute.
     *
     * @param $value
     *
     * @return Carbon|\Illuminate\Support\Collection|int|mixed|static
     */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }

    /**
     * Return URL to post.
     *
     * @param Tag $tag
     * @return string
     */
    public function url(Tag $tag = null)
    {
        $params = [];
        $params['slug'] = $this->slug;
        $params['tag'] = $tag ? $tag->tag : null;

        return route('canvas.blog.post.show', array_filter($params));
    }

    /**
     * Return an array of tag links.
     *
     * @return array
     */
    public function tagLinks()
    {
        $tags = $this->tags()->pluck('tag');
        $return = [];
        foreach ($tags as $tag) {
            $url = route('canvas.blog.post.index', ['tag' => $tag]);
            $return[] = '<a href="'.url($url).'">#'.e($tag).'</a>&nbsp;';
        }

        return $return;
    }

    /**
     * Return next post after this one or null.
     *
     * @param Tag $tag
     * @return Post
     */
    public function newerPost(Tag $tag = null)
    {
        $query =
        static::where('published_at', '>', $this->published_at)
            ->where('published_at', '<=', Carbon::now())
            ->where('is_published', 1)
            ->orderBy('published_at', 'asc');
        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }

        return $query->first();
    }

    /**
     * Return older post before this one or null.
     *
     * @param Tag $tag
     * @return Post
     */
    public function olderPost(Tag $tag = null)
    {
        $query =
        static::where('published_at', '<', $this->published_at)
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc');
        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }

        return $query->first();
    }

    /**
     * Return an approximate reading time for the post. Based on reading time of 275 WPM.
     *
     * @return int
     */
    public function readingTime()
    {
        return round(str_word_count($this->content_raw) / 275);
    }

    /**
     * Return the name of whoever created the post.
     *
     * @param $id
     *
     * @return string
     */
    public static function getAuthor($id)
    {
        return User::where('id', $id)->pluck('display_name')->first();
    }
}
