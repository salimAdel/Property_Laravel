<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];

    public function Categories()
    {
        return $this->hasMany(Category::class);
    }
    public function RealEstateOffer():BelongsTo
    {
        return $this->belongsTo(RealEstateOffer::class);
    }
}
