<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderReply extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
