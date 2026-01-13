<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = ['parking_ru', 'parking_en', 'parking_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
