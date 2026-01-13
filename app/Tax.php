<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = ['tax_ru', 'tax_en', 'tax_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
