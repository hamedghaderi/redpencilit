<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['title', 'body', 'attachment'];

    /**
     * Each ticket belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
       return $this->belongsTo(User::class, 'owner_id');
    }

    public function replies()
    {
       return $this->hasMany(Reply::class)->orderBy('created_at', 'DESC');
    }
}

