<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectNames extends Model {
    
    protected $fillable = ['name_en', 'name_ru', 'name_tm', 'type_id'];

    public function property() {
		return $this->hasMany('App\Property');
    }

	public function type() {
		return $this->belongsTo('App\Type');
    }
    
}
