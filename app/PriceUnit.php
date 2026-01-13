<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceUnit extends Model
{
    protected $fillable = ['unit'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
