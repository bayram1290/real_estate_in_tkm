<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintDetail extends Model
{
    protected $fillable = ['complaint_id','tm', 'ru', 'en'];

    public function complaint(){
        return $this->hasMany('App\Complaint');    
    }

    public function list_comp_detail(){
        return $this->hasMany('App\ListOfComplaints');
    }
}
