<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'gender' => 'boolean'
    ];
}
