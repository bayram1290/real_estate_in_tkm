<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Velayat extends Model
{
	protected $fillable = ['velayat_tm','velayat_ru','velayat_en'];

    public function cities(){
    	return $this->hasMany('App\City');
    }

	public function properties(  ) {
		return $this->hasMany('App\Property');
    }

	public function etrap(  ) {
		return $this->hasMany('App\Velayat');
    }

}
