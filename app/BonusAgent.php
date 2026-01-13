<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusAgent extends Model
{
    protected $fillable = ['bonus_ru', 'bonus_en', 'bonus_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
