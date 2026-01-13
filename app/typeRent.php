<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeRent extends Model{
    
    protected $fillable = ['r_type_ru', 'r_type_en', 'r_type_tm'];
}
