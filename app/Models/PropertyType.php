<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = ['id', 'title', 'description'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
