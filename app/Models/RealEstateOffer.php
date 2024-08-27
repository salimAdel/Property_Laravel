<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RealEstateOffer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];

    public function offerTypes():HasMany
    {
        return $this->hasMany(OfferType::class);
    }
}
