<?php

namespace Canvas\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Canvas\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    /**
     * Config for resetting passwords.
     */
    protected $broker = 'canvas_users';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:canvas');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password'     => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $guard = $this->guard();

        if (! $guard->validate($request->only('password'))) {
            return back()->withErrors(trans('auth.failed'));
        }

        $user = $guard->user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        Session::put('_passwordUpdate', trans('canvas::messages.update_success', ['entity' => 'Your password']));

        return back();
    }
}
