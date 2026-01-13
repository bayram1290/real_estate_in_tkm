<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayWeek extends Model
{
    protected $fillable = ['day'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
