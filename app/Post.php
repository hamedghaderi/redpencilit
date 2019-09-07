<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Stevebauman\Purify\Facades\Purify;

class Post extends Model
{
    use Searchable;
    
    protected $guarded = [];
    
    /**
     * Get the path of a single post.
     *
     * @return string
     */
    public function path()
    {
        return "/posts/".$this->id;
    }
    
    /**
     * Sanitize body attribute.
     *
     * @param $body
     *
     * @return mixed
     */
    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }
    
    /**
     * Each posts belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
       return 'posts_index';
    }
}
