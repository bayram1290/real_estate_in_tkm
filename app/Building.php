<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['building_ru', 'building_en', 'building_tm'];

    public function property()
    {
        return $this->hasOne('App\Property', 'id', 'type_property_id');
    }
}
