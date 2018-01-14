<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('pages.auth.signin');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['fb_id'] = null;

        return $credentials;
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        Auth::login($this->findOrCreateUserWithFacebook($user));
        return redirect($this->redirectTo);
    }

    protected function findOrCreateUserWithFacebook($fbUser)
    {
        $user = User::where('fb_id', $fbUser->id)->first();

        if ($user !== null) {
            return $user;
        }

        return User::create([
            'email' => $fbUser->email,
            'firstname' => $fbUser->name,
            'lastname' => $fbUser->nickname,
            'fb_id' => $fbUser->id
        ]);
    }
}
