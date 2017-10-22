<?php

namespace Canvas\Http\Controllers\Backend;

use Canvas\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * Show the Media Library.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('canvas::backend.upload.index');
    }
}
