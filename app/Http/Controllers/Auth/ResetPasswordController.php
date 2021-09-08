<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest");
    }

    /**
     * Change redirect to method.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route("login", app()->getLocale());
    }

    public function showResetForm(Request $request, $token = null)
    {
        if (!$token) {
            abort(403);
        }

        $found = DB::table("password_resets")
            ->where("email", $request->email)
            ->first();

        if (!$found) {
            return redirect(route("password.request"))
                ->with("message", __("password_reset_failed"))
                ->with("flash_type", "danger");
        }

        if (!Hash::check($token, $found->token)) {
            return redirect(route("password.request"))
                ->with("message", __("password_reset_failed"))
                ->with("flash_type", "danger");
        }

        return view("auth.passwords.reset")->with([
            "token" => $token,
            "email" => $request->get("email"),
        ]);
    }
}
