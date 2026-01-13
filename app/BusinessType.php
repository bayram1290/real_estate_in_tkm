<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    protected $fillable = ['type_ru', 'type_en', 'type_tm'];

    public function property()
    {
        return $this->belongsToMany('App\Property');
    }
}
