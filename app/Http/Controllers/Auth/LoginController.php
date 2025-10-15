<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    protected const ISFIRSTLOGIN = '/user-dashboard';
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function authenticated(Request $request, $user)
    // {

    //     if ($user->isAdmin()) {
    //         return redirect()->route('home');
    //     } else {
    //         return redirect('/user-dashboard');
    //     }
    // }


protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        // ✅ Allow admins regardless of verification
        return redirect()->route('home');
    }

    if ($user->verified_status == 0) {
        // ⛔ Block regular users who aren't verified
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Your email is not verified. Please check your inbox.',
        ]);
    }

    // ✅ Verified non-admin user
    return redirect('/user/my-sessions');
}




}
