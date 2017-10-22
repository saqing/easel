<?php

namespace Canvas\Http\Controllers\Backend;

use Canvas\Models\Tag;
use Canvas\Models\Post;
use Canvas\Models\User;
use Canvas\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display search result.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $params = request('search');

        $posts = Post::search($params)->get();
        $tags = Tag::search($params)->get();
        $users = User::search($params)->get();

        return view('canvas::backend.search.index', compact('posts', 'tags', 'users'));
    }
}
