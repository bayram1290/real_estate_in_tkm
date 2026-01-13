<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotYetUser extends Model
{
    protected $fillable = ['name','last_name','email'];
}
