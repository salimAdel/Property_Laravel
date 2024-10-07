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
    protected $hidden = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function Attachment()
    {
        return $this->hasMany(OfferAttachment::class , 'offer_id');
    }
    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
}
