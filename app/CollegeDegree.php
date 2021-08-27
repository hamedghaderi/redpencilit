<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeDegree extends Model
{
    use HasFactory;

    protected $table = 'college_degrees';

    protected $casts = ['name' => 'array'];
}
