<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['county_id', 'name'];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
