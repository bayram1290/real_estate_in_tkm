<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['first_name','last_name','about','add_phone','avatar', 'user_id'];

	public function user(  ) {
		return $this->belongsTo('App\User');
    }

    public function properties ( ){
		return $this->hasMany('App\Property');
    }
}
