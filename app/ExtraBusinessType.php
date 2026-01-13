<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraBusinessType extends Model
{
    protected $fillable = ['property_id', 'type'];

    // public function property()
    // {
    //     return $this->belongsToMany('App\Property');
    // }
}
