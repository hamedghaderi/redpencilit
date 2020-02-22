<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
   use Notifiable, SoftDeletes, CanResetPasswordTrait;
    
    protected $withCount = ['unreadNotifications'];
    
    protected $fillable
        = [
            'name',
            'email',
            'password',
            'avatar',
            'phone',
            'username',
            'confirmed'
        ];
    
    protected $hidden
        = [
            'password',
            'remember_token',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at'
        ];
    
    protected $casts = ['confirmed' => 'boolean'];
    
    protected $appends = ['isAdmin'];
    
    /**
     * Confirm user email address.
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;
        
        $this->save();
    }
    
    /**
     * Each user may have many settings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function setting()
    {
        return $this->hasOne(Setting::class, 'owner_id');
    }
    
    /**
     * Each user may have many services.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    
    /**
     * Each user may have many drafts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'owner_id');
    }
    
    /**
     * Each user may have many orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'owner_id');
    }
    
    /**
     * A user may have many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    /**
     * Add a role to the current user.
     *
     * @param $roles
     *
     * @return mixed
     */
    public function addRole($roles)
    {
        return $this->roles()->sync($roles);
    }
    
    /**
     * Check if user has a role.
     *
     * @param $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        
        if (is_a($role, Role::class)) {
            return $this->roles->contains($role);
        }
        
        // if role is a collection.
        return ! ! $role->intersect($this->roles)->count();
    }
    
    /**
     * Find admin user.
     *
     * @param $builder
     * @return mixed
     */
    public function scopeAdmin($builder)
    {
        return $builder->whereHas('roles', function ($query) {
            $query->where('name', 'super-admin');
        });
    }
    
    /**
     * Check if a user is super admin.
     *
     * @return mixed
     */
    public function isSuperAdmin()
    {
        return $this->roles->contains('name', 'super-admin');
    }
    
    /**
     * Check if a user has role support.
     *
     * @return mixed
     */
    public function isSupport()
    {
        return $this->roles->contains('name', 'support');
    }
    
    /**
     * A user may have many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'owner_id');
    }
    
    /**
     * A post may have many favorites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favoritable');
    }
    
    /**
     * Each user may have detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }
    
    /**
     * Find superAdmin user.
     *
     * @param $builder
     *
     * @return mixed
     */
    public function scopeSuperAdmin($builder)
    {
        return $builder->whereHas('roles', function ($query) {
            $query->where('name', 'super-admin');
        });
    }
    
    /**
     * Override reset password notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    
    /**
     * Each users may have many tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'owner_id')->orderBy('created_at', 'DESC');
    }
    
    /**
     * Append an isAdmin attribute
     *
     * @return mixed
     */
    public function getIsAdminAttribute()
    {
        return $this->isSuperAdmin();
    }
}

