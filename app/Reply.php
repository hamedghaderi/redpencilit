<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    
    protected $fillable = ['body', 'owner_id', 'ticket_id'];
    
    /**
     * A reply has an owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    /**
     * Each reply belongs to a ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
       return $this->belongsTo(Ticket::class);
    }
}
