<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dealType extends Model{
    
    protected $fillable = ['deal_ru', 'deal_en', 'deal_tm'];
}
