<?php

namespace App\Http\Controllers;

use App\Setting;

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
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($locale)
    {
        $attributes = request()->validate(
            [
                'upload_articles_per_day' => 'required|numeric',
                'upload_words_per_day' => 'required|numeric',
                'price_per_word' => 'required|numeric',
                'base_price_for_docs' => 'required|numeric'
            ]);
        
        $setting = auth()->user()->setting()->create($attributes);
       
        return back()->with('flash', 'تنظیمات با موفقیت ثبت شد.');
    }
    
    /**
     * Update settings with the given attributes.
     *
     * @param           $locale
     * @param  Setting  $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($locale, Setting $setting)
    {
        $attributes = request()->validate([
            'upload_articles_per_day' => 'required|numeric',
            'upload_words_per_day' => 'required|numeric',
            'price_per_word' => 'required|numeric',
            'base_price_for_docs' => 'required|numeric'
        ]);
        
        $setting->update($attributes);
        
        return back()->with('flash', 'تنظیمات به روز رسانی شد.');
    }
}
