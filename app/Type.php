<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name'];


	public function properties(  ) {
		return $this->hasMany('App\Property');
    }

	public function object_names() {
		return $this->hasMany('App\ObjectNames');
    }

}
