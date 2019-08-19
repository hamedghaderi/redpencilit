<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    
    protected $row = null;
    
    protected $guarded = [];
    
    /**
     * Estimate the deliver date.
     *
     * @param $builder
     * @param $files
     */
    public function scopeLastRecords($builder, $files)
    {
        $setting = Setting::find(1);
        
        $builder->orderBy('date')
                ->limit($setting->upload_articles_per_day);
    }
    
    /**
     * Check if current delivery date is not reserved.
     *
     * @param $words
     *
     * @return bool
     */
    public function isNotReserved($words, $files)
    {
        $setting = Setting::first();
        
        return ($this->total_words + $words) < $setting->upload_words_per_day
               && ($this->leftover + count($files)) < $setting->upload_articles_per_day;
    }
}
