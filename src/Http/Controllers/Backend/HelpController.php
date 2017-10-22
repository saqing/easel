<?php

namespace Canvas\Http\Controllers\Backend;

use Canvas\Http\Controllers\Controller;

class HelpController extends Controller
{
    /**
     * Display the help page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('canvas::backend.help.index');
    }
}
