<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'phone', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'email_verified_at', 'created_at', 'updated_at'
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function setting()
    {
       return $this->hasOne(Setting::class, 'owner_id');
    }

    public function documents()
    {
       return $this->hasMany(DocumentDraft::class, 'owner_id');
    }

    public function services()
    {
       return $this->hasMany(Service::class, 'owner_id');
    }

    public function drafts()
    {
       return $this->hasMany(DocumentDraft::class, 'owner_id');
    }
}

