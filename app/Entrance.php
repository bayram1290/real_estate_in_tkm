<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    protected $fillable = ['entrance_ru', 'entrance_en', 'entrance_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
