<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    protected $fillable = ['type_ru', 'type_en', 'type_tm'];

    public function properties()
    {
        return $this->hasMany('App\Property');
    }
}
