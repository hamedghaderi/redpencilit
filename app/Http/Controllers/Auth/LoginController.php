<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function redirectTo()
    {
        return route('dashboard', [app()->getLocale(), auth()->id()]);
    }
    
    public function showLoginForm($lang)
    {
        return view('auth.login');
    }
    
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        
        $this->clearLoginAttempts($request);
        
        if ($this->authenticated($request, $this->guard()->user())) {
            return $this->authenticated($request, $this->guard()->user());
        } else {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 200,
                    'user' => auth()->user(),
                    'token' => csrf_token()
                ]);
            }
            
            return redirect()->intended($this->redirectPath());
        }
        //
        //
        //        return $this->authenticated($request, $this->guard()->user())
        //            ?: redirect()->intended($this->redirectPath());
    }
}
