<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $fillable = ['city_ru', 'city_en', 'city_tm', 'velayat_id'];

	public function properties(  ) {
		return $this->hasMany('App\Property');
    }

	public function velayat(  ) {
		return $this->belongsTo('App\Velayat');
    }
}
