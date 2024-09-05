<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];
    protected $hidden = ['created_at','updated_at','deleted_at'];


    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
    public function RoleBasedPrivileges()
    {
        return $this->hasMany(RoleBasedPrivilege::class);
    }
}
