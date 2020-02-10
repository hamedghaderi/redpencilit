<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterConfirmationController extends Controller
{

    public function index()
    {
        $user = User::where('confirmation_token', request('token'))
                    ->firstOrFail();

        $user->confirm();

        return redirect(route('new-order', app()->getLocale()))
            ->with('flash', 'حساب شما تائید شد. حال می‌توانید سفارشات خود را تکمیل کنید.');
    }
}
