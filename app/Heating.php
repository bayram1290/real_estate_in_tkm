<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heating extends Model
{
    protected $fillable = ['heating_ru', 'heating_en', 'heating_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
