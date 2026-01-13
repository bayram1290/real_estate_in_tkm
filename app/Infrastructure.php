<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infrastructure extends Model
{
    protected $fillable = ['infrastructure_ru', 'infrastructure_en', 'infrastructure_tm', 'img'];

    public function property()
    {
        return $this->belongsToMany('App\Property');
    }
}
