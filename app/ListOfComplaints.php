<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListOfComplaints extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'property_id','complaint_id', 'complaint_detail_id'];

    public function complaint()
    {
        return $this->belongsTo('App\Complaint');
    }

    public function detail()
    {
        return $this->belongsTo('App\ComplaintDetail','complaint_detail_id');
    }

    public function property(){
        return $this->belongsTo('App\Property');
    }
}
