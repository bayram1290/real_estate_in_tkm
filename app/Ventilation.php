<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventilation extends Model
{
    protected $fillable = ['ventilation_ru', 'ventilation_en', 'ventilation_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
