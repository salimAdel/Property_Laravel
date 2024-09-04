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
    public function OfferType():BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }

    public function RealEstateEvaluation():HasMany
    {
        return $this->hasMany(RealEstateEvaluation::class);
    }
}
