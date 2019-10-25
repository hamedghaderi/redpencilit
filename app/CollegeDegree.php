<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeDegree extends Model
{
    protected $table = 'college_degrees';
    
    protected $casts = ['name' => 'array'];
}
