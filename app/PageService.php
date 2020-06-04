<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageService extends Model
{
    protected $guarded = [];
    
    protected $table = 'page_services';
    
    protected $casts = [
        'title' => 'array',
        'description' => 'array'
    ];
}
