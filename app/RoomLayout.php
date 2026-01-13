<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomLayout extends Model {
    
    protected $fillable = ['room_layout_ru', 'room_layout_en', 'room_layout_tm'];

    public function property(){
        return $this->hasMany('App\Property', 'id', 'room_layout_type');
    }
}
