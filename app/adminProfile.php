<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminProfile extends Model
{
    public function admin_user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = ['avatar', 'full_name', 'work_phone', 'about'];
}
