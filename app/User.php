<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'agent'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'admin', 'password', 'remember_token', 'verification_token'
    ];

	public function hasProperty(  ) {
		$data = json_decode($this->properties, true);
		if (empty($data)){
			return false;
		}
		else{
			return true;
		}
    }

	public function properties(  ) {
		return $this->hasMany('App\Property');
    }

	public function favorite_properties(  ) {
		return $this->belongsToMany('App\Property','favorite_user');
    }

	public function profile(  ) {
		return $this->hasOne('App\Profile','user_id');
    }

    public function admin_profile(){
        return $this->hasOne('App\adminProfile');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
