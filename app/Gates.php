<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gates extends Model
{
    protected $fillable = ['gate_ru', 'gate_en', 'gate_tm'];

    public function property()
    {
        return $this->hasMany('App\Propety');
    }
}
