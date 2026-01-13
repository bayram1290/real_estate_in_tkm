<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeEstate extends Model{
    protected $fillable = ['e_type_ru', 'e_type_en', 'e_type_tm'];
}
