<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeRoom extends Model
{
    protected $fillable = ['room_ru', 'room_en', 'room_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
