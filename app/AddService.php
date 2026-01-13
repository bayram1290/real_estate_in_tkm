<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddService extends Model
{
    protected $fillable = ['service_ru', 'service_en', 'service_tm'];

    public function property()
    {
        return $this->belongsToMany('App\Property');
    }
}
