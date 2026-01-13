<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class propertyObject extends Model {
    
    protected $fillable = ['ob_name_ru','ob_name_en', 'ob_name_tm'];
}
