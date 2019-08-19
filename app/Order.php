<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    
    protected $dates = [
        'delivery_date'
    ];
    
    /**
     * Each order may have many details.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
       return $this->hasMany(OrderDetail::class);
    }
}
