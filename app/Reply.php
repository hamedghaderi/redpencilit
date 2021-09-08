<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'owner_id', 'ticket_id'];


    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    public function ticket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
       return $this->belongsTo(Ticket::class);
    }
}
