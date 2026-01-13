<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = ['tm', 'ru', 'en'];

    public function comp_details(){
        return $this->belongsTo('App\ComplaintDetail');
    }

    public function list_comp(){
        return $this->hasMany('App\ListOfComplaints');
    }

}
