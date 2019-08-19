<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    

    /**
     * Each service may exists in many drafts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drafts()
    {
       return $this->hasMany(DocumentDraft::class, 'service_id');
    }
}
