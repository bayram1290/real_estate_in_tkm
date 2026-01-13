<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
	protected $fillable = ['feature_ru','feature_en','type','img'];

	public function property(  ) {
		return $this->belongsToMany('App\Property');
    }
}
