<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloorMaterial extends Model
{
    protected $fillable = ['material_ru', 'material_en', 'material_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
