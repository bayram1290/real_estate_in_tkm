<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firefighting extends Model
{
    protected $fillable = ['firefighting_ru', 'firefighting_en', 'firefighting_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
