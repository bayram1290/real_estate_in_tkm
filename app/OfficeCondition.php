<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeCondition extends Model
{
    protected $fillable = ['condition_ru', 'condition_en', 'condition_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
