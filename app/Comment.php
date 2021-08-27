<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded  = [];

    /**
     * Each Comment may have a testimonial.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function testimonial()
    {
       return $this->hasOne(Testimonial::class);
    }
}
