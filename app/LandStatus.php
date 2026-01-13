<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandStatus extends Model
{
    protected $fillable = ['status_ru', 'status_en', 'status_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }

}
