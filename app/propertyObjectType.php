<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class propertyObjectType extends Model{
    protected $fillable = ['name_ru', 'name_en', 'name_tm'];
}
