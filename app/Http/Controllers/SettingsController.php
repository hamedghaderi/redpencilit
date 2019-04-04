<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(User $user)
    {
       return view('dashboards.settings.index', [
           'setting' => Setting::first() ?: []
       ]);
    }

    public function store(User $user)
    {
        $attributes = request()->validate([
            'upload_articles_per_day' => 'required|numeric',
            'upload_words_per_day' => 'required|numeric',
            'price_per_word' => 'required|numeric',
            'base_price_for_docs' => 'required|numeric'
        ]);

        $user->setting()->create($attributes);

        return back();
    }

    public function update(User $user, Setting $setting)
    {
        $attributes = request()->validate([
            'upload_articles_per_day' => 'required|numeric',
            'upload_words_per_day' => 'required|numeric',
            'price_per_word' => 'required|numeric',
            'base_price_for_docs' => 'required|numeric'
        ]);

        $setting->update($attributes);

        return back();
    }
}
