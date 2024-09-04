<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];

    public function Owner():HasOne
    {
        return $this->hasOne(User::class,'owner_id','id');
    }
    public function Employees():HasMany
    {
        return $this->hasMany(User::class);
    }
}
