<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class DocumentDraft extends Model
{
    protected $guarded = [];

    protected $casts = [
        'recent' => 'boolean'
    ];
}
