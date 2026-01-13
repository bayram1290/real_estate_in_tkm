<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeRepair extends Model
{
    protected $fillable = ['repair_ru', 'repair_en', 'repair_tm'];

    public function property()
    {
        return $this->hasMany('App\Property');
    }
}
