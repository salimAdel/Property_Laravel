<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function RealEstateOffers()
    {
        return $this->hasMany(RealEstateOffer::class);
    }
}
