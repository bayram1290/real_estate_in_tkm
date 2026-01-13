<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandAreaType extends Model
{
    protected $fillable = ['type_ru', 'type_en', 'type_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
