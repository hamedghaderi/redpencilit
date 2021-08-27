<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function permissions()
    {
       return $this->belongsToMany(Permission::class);
    }

    /**
     * Attach permissions to a role.
     *
     * @param $permissions
     */
    public function attachPermissions($permissions)
    {
        return $this->permissions()->attach($permissions->pluck('id'));
    }
}
