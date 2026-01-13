<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conditioning extends Model
{
    protected $fillable = ['conditioning_ru', 'conditioning_en', 'conditioning_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
