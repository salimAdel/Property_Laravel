<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded=[];
    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function OfferType():BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }

    public function RealEstateOffer():HasMany
    {
        return $this->hasMany(RealEstateOffer::class);
    }
}
