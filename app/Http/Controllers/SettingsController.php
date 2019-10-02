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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(
            'dashboards.settings.index', [
            'setting' => Setting::first()
        ]);
    }
    
    /**
     * Persist new settings into DB.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $attributes = request()->validate(
            [
                'upload_articles_per_day' => 'required|numeric',
                'upload_words_per_day' => 'required|numeric',
                'price_per_word' => 'required|numeric',
                'base_price_for_docs' => 'required|numeric'
            ]);
        
        $setting = auth()->user()->setting()->create($attributes);
        
        if (request()->wantsJson()) {
           return response()->json($setting) ;
        }
        
        return back();
    }
    
    /**
     * Update settings with the given attributes.
     *
     * @param  Setting  $setting
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Setting $setting)
    {
        $attributes = request()->validate([
            'upload_articles_per_day' => 'required|numeric',
            'upload_words_per_day' => 'required|numeric',
            'price_per_word' => 'required|numeric',
            'base_price_for_docs' => 'required|numeric'
        ]);
        
        $setting->update($attributes);
        
        if (request()->wantsJson()) {
            return response()->json($setting->fresh());
        }
        
        return back();
    }
}
