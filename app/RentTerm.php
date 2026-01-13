<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentTerm extends Model
{
    protected $fillable  = ['term_ru', 'term_en', 'term_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
