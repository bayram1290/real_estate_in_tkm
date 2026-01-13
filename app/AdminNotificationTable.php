<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminNotificationTable extends Model
{
    protected $fillable = ['username', 'title', 'message'];
}
