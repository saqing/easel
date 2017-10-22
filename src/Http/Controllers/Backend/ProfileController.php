<?php

namespace Canvas\Http\Controllers\Backend;

use Auth;
use Session;
use Canvas\Models\User;
use Canvas\Http\Controllers\Controller;
use Canvas\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userData = Auth::guard('canvas')->user()->toArray();
        $blogData = config('blog');
        $data = array_merge($userData, $blogData);

        return view('canvas::backend.profile.index', compact('data'));
    }

    /**
     * Display the user profile privacy page.
     *
     * @return \Illuminate\View\View
     */
    public function editPrivacy()
    {
        return view('canvas::backend.profile.privacy', [
            'data' => array_merge($this->guard()->user()->toArray(), config('blog')),
        ]);
    }

    /**
     * Update the user profile information.
     *
     * @param ProfileUpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->toArray())->save();
        $user->save();

        Session::set('_profile', trans('canvas::messages.update_success', ['entity' => 'Profile']));

        return redirect()->route('canvas.admin.profile.index');
    }
}
