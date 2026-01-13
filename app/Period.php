<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = ['period_ru', 'period_en', 'period_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
