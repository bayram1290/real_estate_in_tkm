<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Property extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at'];

    public static function boot() {
        parent::boot();

        static::creating(function($model){
            foreach ($model->attributes as $key => $value) {
                $model->{$key} = empty($value) ? 0 : $value;
            }
        });

        static::updating(function($model){
            foreach ($model->attributes as $key => $value) {
                $model->deleted_at = empty($value->deleted_at) ? null : $value->deleted_at;
                $model->{$key} = empty($value) ? 0 : $value;
            }
        });
    }

    public function expired()
    {
        $days = (int)Carbon::now('Asia/Ashgabat')->diffInDays(new Carbon($this->expiring_at), false);
        if ($days < 1) {
            return true;
        } else {
            return false;
        }
    }

    public function expiring_at()
    {
        return Carbon::now()->diffInDays(new Carbon($this->expiring_at), false);
    }

    public function submit_or_resubmit()
    {
        $days = (int)Carbon::now('Asia/Ashgabat')->diffInDays(new Carbon($this->expiring_at), false);
        $result = [];

        if ($days < 1) {
            $result[0] = 'property.resubmit';
            $result[1] = 'Resubmit Property';
            return $result;
        } else {
            $result[0] = 'property.edit';
            $result[1] = 'Submit Property';
            return $result;
        }
    }

    public function feature()
    {
        return $this->belongsToMany('App\Feature');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function description()
    {
        return $this->hasOne('App\PropertyDescription');
    }

    public function revamp()
    {
        return $this->belongsTo('App\Revamp');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function velayat()
    {
        return $this->belongsTo('App\Velayat');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function favorite_user()
    {
        return $this->belongsToMany('App\User', 'favorite_user');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function image()
    {
        return $this->belongsToMany('App\Image');
    }

    public function building()
    {
        return $this->belongsTo('App\Building', 'type_property_id', 'id');
    }

    public function object_names()
    {
        return $this->belongsTo('App\ObjectNames');
    }

    public function list_of_complaints()
    {
        return $this->hasMany('App\ListOfComplaints');
    }

    public function office_repair()
    {
        return $this->belongsTo('App\OfficeRepair');
    }

    public function building_type()
    {
        return $this->belongsTo('App\BuildingType');
    }

    public function ventilation()
    {
        return $this->belongsTo('App\Ventilation');
    }

    public function conditioning()
    {
        return $this->belongsTo('App\Conditioning');
    }

    public function heating()
    {
        return $this->belongsTo('App\Heating');
    }

    public function firefighting()
    {
        return $this->belongsTo('App\Firefighting');
    }

    public function infrastructure()
    {
        return $this->belongsToMany('App\Infrastructure');
    }

    public function bathroom()
    {
        return $this->belongsTo('App\Bathroom');
    }

    public function rent_term()
    {
        return $this->belongsTo('App\RentTerm');
    }

    public function parking()
    {
        return $this->belongsTo('App\Parking');
    }

    public function land_area_type()
    {
        return $this->belongsTo('App\LandAreaType');
    }

    public function day_week()
    {
        return $this->belongsTo('App\DayWeek');
    }

    public function office_condition()
    {
        return $this->belongsTo('App\OfficeCondition');
    }

    public function entrance()
    {
        return $this->belongsTo('App\Entrance');
    }

    public function land_owning_type()
    {
        return $this->belongsTo('App\LandOwningType');
    }

    public function bonus_agent()
    {
        return $this->belongsTo('App\BonusAgent');
    }
    
    public function building_entrance()
    {
        return $this->belongsTo('App\BuildingEntrance');
    }

    public function trade_room()
    {
        return $this->belongsTo('App\TradeRoom');
    }

    public function floor_material()
    {
        return $this->belongsTo('App\FloorMaterial');
    }

    public function gates()
    {
        return $this->belongsTo('App\Gates');
    }

    public function rent_type()
    {
        return $this->belongsTo('App\RentType');
    }

    public function business_type()
    {
        return $this->belongsToMany('App\BusinessType');
    }

    public function business_type_property()
    {
        return $this->belongsTo('App\BusinessTypeProperty');
    }

    public function land_status()
    {
        return $this->belongsTo('App\LandStatus');
    }

    public function period()
    {
        return $this->belongsTo('App\Period');
    }

    public function parking_type()
    {
        return $this->belongsTo('App\ParkingType');
    }

    public function sale_type()
    {
        return $this->belongsTo('App\SaleType');
    }

    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }

    public function add_service()
    {
        return $this->belongsToMany('App\AddService');
    }

    public function price_unit()
    {
        return $this->belongsTo('App\PriceUnit');
    }

    public function apartment_type(){
        return $this->belongsTo('App\ApartmentType');
    }

    public function room_layout(){
        return $this->belongsTo('App\RoomLayout', 'room_layout_type', 'id');
    }
}
