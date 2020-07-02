<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'property_type_id',
        'town_id',
        'description',
        'address',
        'image_full',
        'image_thumbnail',
        'latitude',
        'longitude',
        'num_bedrooms',
        'num_bathrooms',
        'price',
        'listing_type_id'
    ];

    public function type()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function listing_type()
    {
        return $this->belongsTo(ListingType::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
