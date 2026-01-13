<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PossibleAppointment extends Model
{
    protected $fillable = ['appointment_ru', 'appointment_en', 'appointment_tm'];

}
