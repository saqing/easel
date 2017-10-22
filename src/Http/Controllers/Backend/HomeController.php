<?php

namespace Canvas\Http\Controllers\Backend;

use Canvas\Models\Tag;
use Canvas\Models\Post;
use Canvas\Models\User;
use Canvas\Models\Settings;
use Canvas\Helpers\CanvasHelper;
use Illuminate\Support\Facades\App;
use Canvas\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display the application home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'posts' => Post::all(),
            'recentPosts' => Post::orderBy('created_at', 'desc')->take(4)->get(),
            'tags' => Tag::all(),
            'users' => User::all(),
            'disqus' => Settings::disqus(),
            'analytics' => Settings::gaId(),
            'status' => App::isDownForMaintenance() ? CanvasHelper::MAINTENANCE_MODE_ENABLED : CanvasHelper::MAINTENANCE_MODE_DISABLED,
            'canvasVersion' => Settings::canvasVersion(),
            'latestRelease' => Settings::latestRelease(),
        ];

        return view('canvas::backend.home.index', compact('data'));
    }
}
