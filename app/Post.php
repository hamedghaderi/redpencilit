<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Post extends Model
{
    protected $guarded = [];
    
    protected $appends = ['isFavorited'];
    
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
    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'like', "%{$q}%")
            ->orWhere('body', 'like', "%{$q}%");
    }
    
    /**
     * Favorite a post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favoritable');
    }
    
    /**
     * Check if post has favorite by the authenticated user.
     *
     * @return bool
     */
    public function isFavorited()
    {
        return !! $this->favorites()->where('user_id', auth()->id())->count();
    }
    
    /**
     * Make is_favorite an attribute on return json.
     *
     * @return bool
     */
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
}
