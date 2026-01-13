<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyDescription extends Model
{
    protected $fillable = ['description', 'property_id'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}
