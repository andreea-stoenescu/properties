<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $fillable = [
        'uuid',
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
        'listing_type_id',
        'block_api_update'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = $model->uuid ? $model->uuid : Str::uuid();
        });
    }

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
