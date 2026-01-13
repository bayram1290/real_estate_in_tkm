<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class propertyDealType extends Model {
    protected $fillable = ['type_ru', 'type_en', 'type_tm'];
}
