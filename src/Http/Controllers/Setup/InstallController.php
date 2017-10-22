<?php

namespace Canvas\Http\Controllers\Setup;

use Canvas\Http\Controllers\Controller;

class InstallController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('canvasNotInstalled', [
            'except' => [],
        ]);
    }

    /**
     * Display the installation page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('canvas::setup.install');
    }
}
