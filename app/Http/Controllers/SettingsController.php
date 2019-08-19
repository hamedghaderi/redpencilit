<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    
    /**
     * Get the list of all settings.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        return view(
            'dashboards.settings.index', [
            'setting' => Setting::first() ?: []
        ]);
    }
    
    /**
     * Persist new settings into DB.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(User $user)
    {
        $attributes = request()->validate(
            [
                'upload_articles_per_day' => 'required|numeric',
                'upload_words_per_day' => 'required|numeric',
                'price_per_word' => 'required|numeric',
                'base_price_for_docs' => 'required|numeric'
            ]);
        
        $user->setting()->create($attributes);
        
        return back();
    }
    
    /**
     * Update settings with the given attributes.
     *
     * @param  User     $user
     * @param  Setting  $setting
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, Setting $setting)
    {
        $attributes = request()->validate(
            [
                'upload_articles_per_day' => 'required|numeric',
                'upload_words_per_day' => 'required|numeric',
                'price_per_word' => 'required|numeric',
                'base_price_for_docs' => 'required|numeric'
            ]);
        
        $setting->update($attributes);
        
        return back();
    }
}
