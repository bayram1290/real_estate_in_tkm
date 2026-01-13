<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bathroom extends Model
{
    protected $fillable = ['bathroom_ru', 'bathroom_en', 'bathroom_tm'];

    public function properties()
    {
        return $this->hasMany('App\Property');
    }
}
