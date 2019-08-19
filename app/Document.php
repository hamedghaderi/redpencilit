<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    
    use SoftDeletes;
    
    protected $fillable
        = [
            'path',
            'name',
            'token',
            'words',
            'owner_id',
            'delivery_date',
            'completed',
            'confirmed',
            'confirmation_date',
            'completion_date',
            'price'
        ];
    
    public function scopeEstimatedDate($query)
    {
        $limit = Setting::first()->upload_articles_per_day;
        
        $query->orderBy('delivery_date', 'desc')->limit($limit);
    }
}
