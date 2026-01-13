<?php

namespace App\Http\Controllers;

use URL;
use DB;

use App\AddService;
use App\Advertisement;
use App\Bathroom;
use App\BonusAgent;
use App\Building;
use App\BuildingEntrance;
use App\BuildingType;
use App\BusinessType;
use App\BusinessTypeProperty;
use App\City;
use App\Conditioning;
use App\Entrance;
use App\Feature;
use App\Firefighting;
use App\FloorMaterial;
use App\Gates;
use App\Heating;
use App\Image;
use App\ExtraBusinessType;
use App\Infrastructure;
use App\LandAreaType;
use App\LandOwningType;
use App\LandStatus;
use App\ListOfComplaints;
use App\ObjectNames;
use App\OfficeCondition;
use App\OfficeRepair;
use App\Parking;
use App\ParkingType;
use App\Period;
use App\PossibleAppointment;
use App\Property;
use App\PropertyDescription;
use App\RentTerm;
use App\RentType;
use App\Revamp;
use App\SaleType;
use App\Tax;
use App\TradeRoom;
use App\Type;
use App\Velayat;
use App\Ventilation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Geocoder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use File;
use App\Complaint;
use App\ComplaintDetail;
use App\accountType;
use App\dealType;
use App\typeRent;
use App\typeEstate;
use App\typePropertyList;
use App\ApartmentType;
use App\RoomLayout;
use App\siteSetting;
use App\propertyDealType;
use App\propertyObjectType;
use App\AdminNotificationTable;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class PropertyController extends Controller
{
    /**
     * Get all properties
     * @return mixed
     */
    public function getProperties()
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $current = Carbon::now();
        $properties = Property::where('accepted', 1)->where('expiring_at', '>', $current);
        $property_count = is_null($properties->get()) ? 0 : count($properties->get());

        return view('property.list')
            ->with('properties', $properties->orderBy('created_at', 'desc')->paginate(8))
            ->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
            ->with('features', Feature::all())            
            ->with('revamps', Revamp::all())
            ->with('cities', City::all())
            ->with('parkings', Parking::all())
            ->with('objects', ObjectNames::all())
            ->with('ads', Advertisement::where('active', 1)->get())
            ->with('conditions', OfficeCondition::all())
            ->with('build_appoints', BuildingType::all())
            ->with('infras', Infrastructure::all())
            ->with('r_types', RentType::all())
            ->with('buss_t_props', BusinessTypeProperty::all())
            ->with('st_props', LandOwningType::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('apartment_types', ApartmentType::all())
            ->with('buildings', Building::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('sale_types', SaleType::all())
            ->with('land_owning_types', LandOwningType::all())
            ->with('prop_count', $property_count)
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray());
    }

    /**
     * Search property by parameters
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function searchProperty(Request $request)
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }
        
        $price = explode(';', $request->price);
        $price[0] = (double)$price[0];
        $price[1] = (double)$price[1];

        $area = explode(';', $request->area);
        $area[0] = (double)$area[0];
        $area[1] = (double)$area[1];        

        $r_terr=$s_terr=$cnt_room=$floor=$tot_floor=$t_rents=$decor=$price_unit=$res_park=$com_park=$t_build=$buss_t_prop=$prop_status=$condition=$features=$prepayment=$t_premises=$day_week=$t_house=$floor_mat=$infras=$type_sale=$prop_status=$debt_amount=$apartType=null;
        $properties = Property::where('accepted', 1)
                            ->where('saleOrRent', $request->sale)
                            ->where('object_names_id', $request->object)
                            ->whereBetween('area', [$area[0], $area[1]])
                            ->where('velayat_id', $request->velayat);                            

        if( $request->city1 !== '0' ){
            $properties = $properties->where('city_id', $request->city1);
        }
        
        if( isset( $request->price_unit ) ){
            $properties = $properties->where('price_unit_id', 2);
            $price_unit = 1;
        }else{
            $properties = $properties->where('price_unit_id', 1);
            $price_unit = 0;
        }

        if( $request->object > 5 ){
            if($request->sale == 0) $r_terr = $request->rent_pr_terr;
            else $s_terr = $request->sale_pr_terr;
        }
        
        
        if( $request->object > 5 && ( ($request->sale == 0 && $request->rent_pr_terr == '2') || ($request->sale == 1 && $request->sale_pr_terr == '2') ) ){
            $properties = $properties->whereBetween('price_rate', [$price[0], $price[1]]);
        }else{
            $properties = $properties->whereBetween('price', [$price[0], $price[1]]);
        }
        
        switch( $request->object ){
            case 1:
                if( $request->cnt_room && count($request->cnt_room) !== 4 ){
                    $properties = $properties->whereIn('rooms', $request->cnt_room);                    
                }

                if( $request->cnt_room ){
                    $cnt_room = $request->cnt_room;
                }else{
                    $cnt_room = 0;
                }
                
                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }                

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->apart_type ){
                    $properties = $properties->where('apartment_type_id', $request->apart_type);
                    $apartType = $request->apart_type;
                }

                if( $request->decor ){
                    $properties = $properties->where('revamp_id', $request->decor);
                    $decor = $request->decor;
                }

                if( $request->t_house ){
                    $properties = $properties->where('type_property_id', $request->t_house);
                    $t_house = $request->t_house;
                }
                
                if( $request->features && $properties->pluck('id')->toArray() ){
                    $returned_array = $this->checkFeatures($properties->pluck('id')->toArray(), $request->features);
                    if( !empty( $returned_array ) ) $properties = $properties->whereIn('id', $returned_array);
                }
                if( $request->features ) $features = $request->features;
                break;
            
            
            case 2:
                if( $request->cnt_room ){
                    $cnt_room = $request->cnt_room;
                }else{
                    $cnt_room = 0;
                }
                if( $request->cnt_room && count($request->cnt_room) !== 5 ){
                    $properties = $properties->whereIn('rooms', $request->cnt_room);                    
                }

                if( $request->cnt_room ){
                    $cnt_room = $request->cnt_room;
                }else{
                    $cnt_room = 0;
                }
                
                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }                

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->apart_type ){
                    $properties = $properties->where('apartment_type_id', $request->apart_type);
                    $apartType = $request->apart_type;
                }
                
                if( $request->decor ){
                    $properties = $properties->where('revamp_id', $request->decor);
                    $decor = $request->decor;
                }

                if( $request->res_parking ){
                    $properties = $properties->where('parking_id', $request->res_parking);
                    $res_park = $request->res_parking;
                }

                if( $request->sale == '1' ){
                    if( $request->t_sale ){
                        $properties = $properties->where('sale_type_id', $request->t_sale);
                        $type_sale = $request->t_sale;
                    }
                    
                    if( $request->home_status ){
                        $properties = $properties->where('house_purchase_status', $request->home_status);
                        $prop_status = $request->home_status;
                    }

                    if( $request->debt_amount && $request->home_status == '2' ){
                        $properties = $properties->where('house_purchase_debt_amount', '<=' ,$request->debt_amount);
                        $debt_amount = $request->debt_amount;
                    }

                }

                if( $request->features && $properties->pluck('id')->toArray() ){
                    $returned_array2 = $this->checkFeatures($properties->pluck('id')->toArray(), $request->features);
                    if( !empty( $returned_array2 ) ) $properties = $properties->whereIn('id', $returned_array2);
                }
                if( $request->features ) $features = $request->features;
                break;

            case 3:
            case 4:
                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->decor && $request->sale == '0' ){
                    $properties = $properties->where('revamp_id', $request->decor);
                    $decor = $request->decor;
                }

                if( $request->features && $properties->pluck('id')->toArray() ){
                    $returned_array1 = $this->checkFeatures($properties->pluck('id')->toArray(), $request->features);
                    if( !empty( $returned_array1 ) ) $properties = $properties->whereIn('id', $returned_array1);
                }
                if( $request->features ) $features = $request->features;
                break;
            
            case 5:
                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->t_house){
                    $properties = $properties->where('type_property_id', $request->t_house);
                    $t_house = $request->t_house;
                }

                if( $request->decor && $request->sale == '0' ){
                    $properties = $properties->where('revamp_id', $request->decor);
                    $decor = $request->decor;
                }

                if( $request->prepayment && $request->sale == '0' ){                    
                    $properties = $properties->where('prepayment', $request->prepayment);
                    $prepayment = $request->prepayment;
                }

                if( $request->features && $properties->pluck('id')->toArray() ){
                    $returned_array2 = $this->checkFeatures($properties->pluck('id')->toArray(), $request->features);
                    if( !empty( $returned_array2 ) ) $properties = $properties->whereIn('id', $returned_array2);
                }
                if( $request->features ) $features = $request->features;
                break;

            case 6:
                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->condition ){
                    $condition = $request->condition;
                    if( $request->condition == 1 ){
                        $properties = $properties->where('office_condition_id', '<>', '3');
                    }else{
                        $properties = $properties->where('office_condition_id', $request->condition);
                    }                    
                }

                if( $request->res_parking ){
                    $properties = $properties->where('parking_id', $request->res_parking);
                    $res_park = $request->res_parking;
                }

                if( $request->t_rents && $request->sale == '0'){
                    $properties = $properties->where('rent_type_id', $request->t_rents);
                    $t_rents = $request->t_rents;
                }

                if( $request->prepayment && $request->sale == '0'){
                    $properties = $properties->where('prepayment', $request->prepayment);
                    $prepayment = $request->prepayment;
                }

                if( $request->infras && $properties->pluck('id')->toArray() ){
                    $returned_infra_ids = $this->checkInfras($properties->pluck('id')->toArray(), $request->infras);
                    if( !empty( $returned_infra_ids ) ) $properties = $properties->whereIn('id', $returned_infra_ids);
                }

                if( $request->infras ) $infras = $request->infras;
                break;

            case 7:
                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }
                
                if( $request->condition ){
                    $condition = $request->condition;
                    if( $request->condition == 1 ){
                        $properties = $properties->where('office_condition_id', '<>', '3');
                    }else{
                        $properties = $properties->where('office_condition_id', $request->condition);
                    }
                }

                if( $request->res_parking ){
                    $properties = $properties->where('parking_id', $request->res_parking);
                    $res_park = $request->res_parking;
                }

                if( $request->t_rents && $request->sale == '0'){
                    $properties = $properties->where('rent_type_id', $request->t_rents);
                    $t_rents = $request->t_rents;
                }

                if( $request->prepayment && $request->sale == '0'){
                    $properties = $properties->where('prepayment', $request->prepayment);
                    $prepayment = $request->prepayment;
                }
                break;

            case 8:
                if( $request->t_premises ){
                    $properties = $properties->where('trade_room_id', $request->t_premises);
                    $t_premises = $request->t_premises;
                }

                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }                

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->condition ){
                    $condition = $request->condition;
                    if( $request->condition == 1 ){
                        $properties = $properties->where('office_condition_id', '<>', '3');
                    }else{
                        $properties = $properties->where('office_condition_id', $request->condition);
                    }
                }

                if( $request->day_week ){
                    $properties = $properties->where('day_week_id', $request->day_week);
                    $day_week = $request->day_week;
                }
                
                if( $request->t_rents && $request->sale == '0'){
                    $properties = $properties->where('rent_type_id', $request->t_rents);
                    $t_rents = $request->t_rents;
                }

                if( $request->prepayment && $request->sale == '0'){
                    $properties = $properties->where('prepayment', $request->prepayment);
                    $prepayment = $request->prepayment;
                }

                if( $request->infras && $properties->pluck('id')->toArray() ){
                    $returned_infra_ids = $this->checkInfras($properties->pluck('id')->toArray(), $request->infras);
                    if( !empty( $returned_infra_ids ) ) $properties = $properties->whereIn('id', $returned_infra_ids);
                }

                if( $request->infras ) $infras = $request->infras;
                break;

            case 9:
                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }                

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->floor_mat ){
                    $properties = $properties->where('floor_material_id', $request->floor_mat);
                    $floor_mat = $request->floor_mat;
                }

                if( $request->condition ){
                    $condition = $request->condition;
                    if( $request->condition == 1 ){
                        $properties = $properties->where('office_condition_id', '<>', '3');
                    }else{
                        $properties = $properties->where('office_condition_id', $request->condition);
                    }
                }

                if( $request->com_parking ){
                    $properties = $properties->where('parking_id', $request->com_parking);
                    $com_park = $request->com_parking;
                }

                if( $request->infras && $properties->pluck('id')->toArray() ){
                    $returned_infra_ids = $this->checkInfras($properties->pluck('id')->toArray(), $request->infras);
                    if( !empty( $returned_infra_ids ) ) $properties = $properties->whereIn('id', $returned_infra_ids);
                }

                if( $request->infras ) $infras = $request->infras;
                break;

            case 10:
                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }                

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->condition ){
                    $condition = $request->condition;
                    if( $request->condition == 1 ){
                        $properties = $properties->where('office_condition_id', '<>', '3');
                    }else{
                        $properties = $properties->where('office_condition_id', $request->condition);
                    }
                }

                if( $request->com_parking ){
                    $properties = $properties->where('parking_id', $request->com_parking);
                    $com_park = $request->com_parking;
                }
                
                if( $request->t_build ){
                    $properties = $properties->where('building_type_id', $request->t_build);
                    $t_build = $request->t_build;
                }

                if( $request->t_rents && $request->sale == '0'){
                    $properties = $properties->where('rent_type_id', $request->t_rents);
                    $t_rents = $request->t_rents;
                }

                if( $request->prepayment && $request->sale == '0'){
                    $properties = $properties->where('prepayment', $request->prepayment);
                    $prepayment = $request->prepayment;
                }

                if( $request->infras && $properties->pluck('id')->toArray() ){
                    $returned_infra_ids = $this->checkInfras($properties->pluck('id')->toArray(), $request->infras);
                    if( !empty( $returned_infra_ids ) ) $properties = $properties->whereIn('id', $returned_infra_ids);
                }

                if( $request->infras ) $infras = $request->infras;
                break;

            case 11:
                if( $request->floor ){
                    $properties = $properties->where('floor', $request->floor);
                    $floor = $request->floor;
                }                

                if( $request->tot_floor ){
                    $properties = $properties->where('floors_in_home', $request->tot_floor);
                    $tot_floor = $request->tot_floor;
                }

                if( $request->condition ){
                    $condition = $request->condition;
                    if( $request->condition == 1 ){
                        $properties = $properties->where('office_condition_id', '<>', '3');
                    }else{
                        $properties = $properties->where('office_condition_id', $request->condition);
                    }
                }
                
                if( $request->buss_t_prop ){
                    $properties = $properties->where('business_type_property_id', $request->buss_t_prop);
                    $buss_t_prop = $request->buss_t_prop;
                }
                
                if( $request->prepayment && $request->sale == '0'){
                    $properties = $properties->where('prepayment', $request->prepayment);
                    $prepayment = $request->prepayment;
                }

                if( $request->prop_status && $request->sale == '1'){
                    $properties = $properties->where('land_owning_type_id', $request->prop_status);
                    $prop_status = $request->prop_status;
                }
                break;
        }

        switch( $request->filter ){
            case 2:
                $properties = $properties->orderBy('created_at', 'asc');
                break;

            case 3:
                $properties = $properties->orderBy('price', 'asc');
                break;

            case 4:
                $properties = $properties->orderBy('price', 'desc');
                break;

            case 5:
                $properties = $properties->orderBy('area', 'asc');
                break;

            case 6:
                $properties = $properties->orderBy('area', 'desc');
                break;

            default:
                $properties = $properties->orderBy('created_at', 'desc');
        }

        $property_count = is_null($properties->get()) ? 0 : count($properties->get());
        
        return view('property.list')
            ->with('properties', $properties->paginate(8))
            ->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
            ->with('features', Feature::all())            
            ->with('revamps', Revamp::all())
            ->with('cities', City::all())
            ->with('types_' . $lang, Type::all())
            ->with('parkings', Parking::all())
            ->with('objects', ObjectNames::all())
            ->with('ads', Advertisement::where('active', 1)->get())
            ->with('conditions', OfficeCondition::all())
            ->with('build_appoints', BuildingType::all())
            ->with('infras', Infrastructure::all())
            ->with('r_types', RentType::all())
            ->with('buss_t_props', BusinessTypeProperty::all())
            ->with('st_props', LandOwningType::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('apartment_types', ApartmentType::all())
            ->with('buildings', Building::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('sale_types', SaleType::all())
            ->with('selected_deal', $request->sale)
            ->with('selected_object', $request->object)
            ->with('selected_velayat', $request->velayat)
            ->with('selected_city', $request->city1)
            ->with('selected_area', $request->area)
            ->with('selected_filter', $request->filter)
            ->with('selected_price', $request->price)
            ->with('selected_price_unit', $price_unit)
            ->with('selected_rent_terr', $r_terr)
            ->with('selected_sale_terr', $s_terr)
            ->with('selected_rooms', $cnt_room)
            ->with('selected_floor', $floor)
            ->with('selected_tot_floor', $tot_floor)
            ->with('selected_t_rents', $t_rents)
            ->with('selected_decor', $decor)            
            ->with('selected_res_parking', $res_park)
            ->with('selected_com_parking', $com_park)            
            ->with('selected_t_build', $t_build)
            ->with('selected_buss_t_prop', $buss_t_prop)
            ->with('selected_prop_status', $prop_status)            
            ->with('selected_condition', $condition)
            ->with('selected_features', $features)
            ->with('selected_prepayment', $prepayment)
            ->with('selected_t_premises', $t_premises)
            ->with('selected_day_week', $day_week)
            ->with('selected_t_house', $t_house)
            ->with('selected_floor_mat', $floor_mat)
            ->with('selected_infras', $infras)
            ->with('selected_type_sale', $type_sale)
            ->with('selected_property_status', $prop_status)
            ->with('selected_debt_amount', $debt_amount)
            ->with('selected_apart_type', $apartType)
            ->with('prop_count', $property_count)
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray());
    }

    public function searchPropertyMain(Request $request)
    {

        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }
        
        $city=$min_price=$max_price=$price_unit=$cnt_room=$price_terr=$price_terr_rent=$min_ar_fil=$max_ar_fil=null;

        $cities = City::all();
        $types = Type::all();
        $revamps = Revamp::all();        

        $ads = Advertisement::where('active', 1)->get();
        
        if( $request->min_price > 0 && $request->min_price !== null ){
            $min_price = $request->min_price;
            $min_price = str_replace(',', '', $min_price);
        }       
       
        if( $request->max_price > 0 && $request->max_price !== null ){
            $max_price = $request->max_price;
            $max_price = str_replace(',', '', $max_price);
        }

        $price_flag = 0;
        if( $min_price > 0 ){
            $price_flag = 1;
        }

        if( $max_price > 0 ){
            $price_flag += 2;
        }

        if( $request->min_ar_fil > 0 && $request->min_ar_fil !== null ){
            $min_ar_fil = $request->min_ar_fil;
            $min_ar_fil = str_replace(',', '', $min_ar_fil);
        }

        if( $request->max_ar_fil > 0 && $request->max_ar_fil !== null ){
            $max_ar_fil = $request->max_ar_fil;
            $max_ar_fil = str_replace(',', '', $max_ar_fil);
        }

        $ar_fil_flag = 0;
        if( $min_ar_fil > 0 ){
            $ar_fil_flag = 1;
        }

        if( $max_ar_fil > 0 ){
            $ar_fil_flag += 2;
        }

        $room_cnt_flag = 0;
        if( !is_null($request->cnt_room) && count($request->cnt_room) !== 0 && (count($request->cnt_room) !== 4 && $request->object === '1' || count($request->cnt_room) !== 5 && $request->object == '2') ){
            $room_cnt_flag = 1; 
        }

        if( $request->cnt_room ){
            $cnt_room = $request->cnt_room;
        }else{
            $cnt_room = 0;
        }

        $properties = Property::where('accepted', 1)
            ->where('saleOrRent', $request->sale)
            ->where('object_names_id', $request->object)
            ->where('velayat_id', $request->velayatt)            
            ->where('price_unit_id', $request->price_unit);

        if( $request->cityy != 0 ){
            $properties = $properties->where('city_id', $request->cityy);
            $city = $request->cityy;
        }else{
            $city = 0;
        }

        $price_unit = ( $request->price_unit == 2 ) ? 1 : 0;     
        
        if( $request->object > 5 ){
            if( $request->sale == 0 ) $price_terr_rent = $request->price_terr_rent;
            else $price_terr = $request->price_terr; 
        }
        
        if( $request->object > 5 && ( ($request->sale == 0 && $request->price_terr_rent == '2') || ($request->sale == 1 && $request->price_terr == '2') ) ){
            switch( $price_flag ){
                case 1:
                    $properties = $properties->where('price_rate', '>=', $min_price);                    
                break;
                    
                case 2:
                    $properties = $properties->where('price_rate', '<=', $max_price);
                break;
    
                case 3:
                    $properties = $properties->whereBetween('price_rate', [$min_price, $max_price]);                    
                break;
            }
            
        }else{
            switch( $price_flag ){
                case 1:
                    $properties = $properties->where('price', '>=', $min_price);
                break;
                    
                case 2:
                    $properties = $properties->where('price', '<=', $max_price);
                break;
    
                case 3:
                    $properties = $properties->whereBetween('price', [$min_price, $max_price]);
                break;
            }
        }

        if( $room_cnt_flag ){
            $properties = $properties->whereIn('rooms', $request->cnt_room);
        }

        switch( $ar_fil_flag ){
            case 1:
                $properties = $properties->where('area', '>=', $request->min_ar_fil);
            break;

            case 2:
                $properties = $properties->where('area', '<=', $request->max_ar_fil);
            break;

            case 3:
                $properties = $properties->whereBetween('area', [$request->min_ar_fil, $request->max_ar_fil]);
            break;
        }

        $property_count = is_null($properties->get()) ? 0 : count($properties->get());

        return view('property.list')
            ->with('properties', $properties->orderBy('created_at')->paginate(8))
            ->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
            ->with('cities',$cities)
            ->with('features', Feature::all())           
            ->with('revamps', $revamps)->with('cities', City::all())
            ->with('types_' . $lang, $types)
            ->with('st_props', LandOwningType::all())
            ->with('parkings', Parking::all())
            ->with('objects', ObjectNames::all())
            ->with('ads', Advertisement::where('active', 1)->get())
            ->with('conditions', OfficeCondition::all())
            ->with('build_appoints', BuildingType::all())
            ->with('infras', Infrastructure::all())
            ->with('buss_t_props', BusinessTypeProperty::all())
            ->with('r_types', RentType::all())
            ->with('buss_t_props', BusinessTypeProperty::all())
            ->with('st_props', LandOwningType::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('apartment_types', ApartmentType::all())
            ->with('buildings', Building::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('sale_types', SaleType::all())
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray())
            ->with('selected_deal', $request->sale)
            ->with('selected_object', $request->object)
            ->with('selected_velayat', $request->velayatt)
            ->with('selected_city', $city)
            ->with('selected_price_unit', $price_unit)
            ->with('selected_filter', 1)
            ->with('selected_rent_terr', $price_terr_rent)
            ->with('selected_sale_terr', $price_terr)
            ->with('selected_min_price', $min_price)
            ->with('selected_max_price', $max_price)
            ->with('selected_rooms', $cnt_room)
            ->with('selected_min_area', $min_ar_fil)
            ->with('selected_max_area', $max_ar_fil)
            ->with('prop_count', $property_count);
    }

    /**
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterType(Request $request)
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $filter = [];


        if (isset($request->type)) {
            switch ($request->type) {
                case 2:
                    $saleOrRent = 0;
                    break;
                case 3:
                    $saleOrRent = 1;
                    break;
            }
        }

        if (isset($request->filter)) {
            switch ($request->filter) {
                case 1:
                    break;
                case 3:
                    array_push($filter, 'price', 'desc');
                    break;
                case 4:
                    array_push($filter, 'price', 'asc');
                    break;
                case 5:
                    array_push($filter, 'created_at', 'desc');
                    break;
                case 6:
                    array_push($filter, 'created_at', 'asc');
                    break;
            }
        }

        if (isset($saleOrRent)) {
            if (!empty($filter)) {
                $filtered_property = Property::where('accepted', 1)->where('saleOrRent', $saleOrRent)->orderBy($filter[0], $filter[1])->paginate(8);
            } else {
                $filtered_property = Property::where('accepted', 1)->where('saleOrRent', $saleOrRent)->paginate(8);
            }
        } else {
            if (empty($filter)) {
                $filtered_property = Property::where('accepted', 1)->paginate(8);
            } else {
                $filtered_property = Property::where('accepted', 1)->orderBy($filter[0], $filter[1])->paginate(8);
            }
        }

        $result = '';

        foreach ($filtered_property as $item) {
            if ($item->saleOrRent) {
                $saleOrRent = 'Sale';
                $price = number_format($item->price);
            } else {
                $saleOrRent = 'Rent';
                $price = number_format($item->price) . '/mo';
            }
            $result .= "<div class='col-md-6 col-sm-6'>
                            <div class='property_grid'>
                                <div class='img_area'>
                                    <div class='sale_btn'>{$saleOrRent}</div>
                                    <a href='#'><img src='{$item->img}' alt=''></a>
                                    <div class='sale_amount'>{$item->created_at->diffForHumans()}</div>
                                    <div class='hover_property'>
                                        <ul>
                                            <li><a href='#'><i class='fa fa-search' aria-hidden='true'></i></a></li>
                                            <li><a href='#'><i class='fa fa-link' aria-hidden='true'></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='property-text'>
                                    <a href='#'>
                                        <h5 class='property-title'>{$item->title}</h5>
                                    </a> <span><i class='fa fa-map-marker' aria-hidden='true'></i> {$item->address} </span>
                                    <div class='quantity'>
                                        <ul>
                                            <li><span>Area</span>{$item->area} Sqft</li>
                                            <li><span>Rooms</span>{$item->rooms}</li>
                                            <li><span>City</span>{$item->city->city}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class='bed_area'>
                                    <ul>
                                        <li>$ {$price}</li>
                                        <li class='flat-icon'><a href='#'><i class='flaticon-like'></i></a></li>
                                        <li class='flat-icon'><a href='#'><i class='flaticon-connections'></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>";
        }

        $msg = array('filtered_properties' => $result, 'links' => $filtered_property);

        return response()->json($msg);

    }

    /**
     * Get one particular property
     *
     * @param $id
     *
     * @return mixed
     */
    public function single_living($id){
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }
        
        $property = Property::find($id);
        $prop_owner_id = $property->user_id;
        $current_date = Carbon::now('Asia/Ashgabat');
                
        if( Auth::id() !== $prop_owner_id ){
            DB::table('properties')->where('id', $id)->update([ 'views' => $property->views += 1]);

            if( $current_date->isSameDay( Carbon::parse( $property->current_day ) ) ){
                DB::table('properties')->where('id', $id)->update([ 'current_day_views' => $property->current_day_views += 1 ]);
            } else {
                DB::table('properties')->where('id', $id)->update([ 'current_day_views' => $property->current_day_views = 1, 'current_day' => $current_date ]);
            }
        }

        $user_prop_cnt = Property::where('user_id', $prop_owner_id)->get()->count();

        $ads = Advertisement::where('active', 1)->get();        
        $apiKey = "AIzaSyAa-tem4p6Olh9FaFUKS0YAZy4bHHzyyLM";

        //$information = Geocoder::getCoordinatesForAddress( $property->address, $apiKey );

        $ids = $this->related_properties($id);
        $flag = end($ids);
        if( $flag !== 0 ){
            
            unset($ids[array_search($id, $ids)]);
            unset($ids[array_search($flag, $ids)]);            
            $related_properties = Property::whereIn('id', $ids)->orderBy('created_at', 'desc')->get();
        }

        return view('property.single_living')            
            ->with('property', $property)
            ->with('parkings', Parking::all())
            ->with('land_statuses', LandStatus::all())
            ->with('rent_terms', RentTerm::all())
            ->with('sale_types', SaleType::all())
            ->with('cities', City::all())
            ->with('related_property_flag', $flag)
            ->with('related_properties', $related_properties)
            ->with('ads', $ads)            
            ->with('property_counter', $user_prop_cnt)
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_tm')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray());
            
    }

    public function single_commercial($id){
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $property = Property::find($id);
        $prop_owner_id = $property->user_id;
        $current_date = Carbon::now('Asia/Ashgabat');
        
        if( Auth::id() !== $prop_owner_id ){
            DB::table('properties')->where('id', $id)->update([ 'views' => $property->views += 1]);

            if( $current_date->isSameDay( Carbon::parse( $property->current_day ) ) ){
                DB::table('properties')->where('id', $id)->update([ 'current_day_views' => $property->current_day_views += 1 ]);
            } else {
                DB::table('properties')->where('id', $id)->update([ 'current_day_views' => $property->current_day_views = 1, 'current_day' => $current_date ]);
            }
        }
        
        $user_prop_cnt = Property::where('user_id', $prop_owner_id)->get()->count();

        $months_ru = ["янв", "фев", "мар", "апр", "май", "июн", "июл", "авг", "сент", "окт", "ноя", "дек"];
        $months_en = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
        $months_tm = ["ýan", "few", "mar", "apr", "maý", "iýun", "iýul", "awg", "sent", "okt", "noý", "dek"];

        $ads = Advertisement::where('active', 1)->get();
        //$properties = Property::where('type_id', $property->type_id)->get();
        $apiKey = "AIzaSyAa-tem4p6Olh9FaFUKS0YAZy4bHHzyyLM";       

        $ids = $this->related_properties($id);
        $flag = end($ids);
        if( $flag !== 0 ) {
            unset($ids[array_search($id, $ids)]);
            unset($ids[array_search($flag, $ids)]);
            $related_properties = Property::whereIn('id', $ids)->orderBy('created_at', 'desc')->get();
        }
        
        //$information = Geocoder::getCoordinatesForAddress( $property->address, $apiKey );
        
        return view('property.single_commercial')
            ->with('property', $property)            
            ->with('rent_types', RentType::all())
            ->with('rent_terms', RentTerm::all())
            ->with('office_repairs', OfficeRepair::all())
            ->with('entrances', Entrance::all())
            ->with('parkings', Parking::all())
            ->with('ventilations', Ventilation::all())
            ->with('conditionings', Conditioning::all())
            ->with('heatings', Heating::all())
            ->with('firefightings', Firefighting::all())
            ->with('building_types', BuildingType::all())
            ->with('building_entrances', BuildingEntrance::all())
            ->with('land_owning_types', LandOwningType::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('extra_possible_business_types', ExtraBusinessType::where('property_id', $id)->get())
            ->with('gates', Gates::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('parking_types', ParkingType::all())
            ->with('business_types_property', BusinessTypeProperty::all())
            ->with('taxes', Tax::all())
            ->with('related_property_flag', $flag)
            ->with('related_properties', $related_properties)
            ->with('ads', $ads)
            ->with('months_ru', $months_ru)
            ->with('months_en', $months_en)
            ->with('months_tm', $months_tm)
            ->with('property_counter', $user_prop_cnt)
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_tm')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray());
    }
   

    /*
     * Posting property
     */
    public function submit_property(Request $request)
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }

        $this->validate($request, [
            'title' => 'required',
            'area' => 'required|numeric',
            'object' => 'required',
            'type' => 'required',
            'city' => 'required',
            'velayat' => 'required',
            'repair' => 'required',
            'address' => 'required',
            'balcony' => 'required',
            'service_lift' => 'required',
            'pass_lift' => 'required',
            'floor' => 'required',
            'floors_in_home' => 'required',
            'type_property' => 'required',
            'price' => 'required|numeric',
            'rooms' => 'required|numeric|between:1,10',
            'description' => 'required|min:100',
            'img' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $featured = false;
        if (!(empty($featured))) {
            $featured = true;
        }

        $photoNames = [];
        $photoIds = [];

        $i = Image::count();
        $c = 0;
        foreach ($request->img as $img) {
            array_push($photoNames, time() . '.' . $img->getClientOriginalExtension());

            $img->move(public_path('img\property_grid'), $photoNames[$c]);

            Image::create([
                'id' => $i + 1,
                'name' => $photoNames[$c]
            ]);
            $i++;
            $c++;
            array_push($photoIds, $i);
        }

        $property = Property::create([
            'title' => $request->title,
            'rooms' => $request->rooms,
            'type_id' => $request->type,
            'object_names_id' => $request->object,
            'address' => $request->address,
            'city_id' => $request->city,
            'user_id' => Auth::id(),
            'floor' => $request->floor,
            'floors_in_home' => $request->floors_in_home,
            'toilets' => $request->toilets,
            'revamp_id' => $request->repair,
            'type_of_toilets' => $request->toilet_type,
            'type_property_id' => $request->type_property,
            'passenger_lift' => $request->pass_lift,
            'service_lift' => $request->service_lift,
            'balcony' => $request->balcony,
            'profile_id' => Auth::user()->profile->id,
            'area' => $request->area,
            'price' => $request->price,
            'featured' => $featured,
            'saleOrRent' => $request->status,
            'velayat_id' => $request->velayat,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'expiring_at' => Carbon::now('Asia/Ashgabat')->addMonth(),
            'img' => 'img/property_grid/' . $photoNames[0]
        ]);

        PropertyDescription::create([
            'description' => $request->description,
            'property_id' => $property->id
        ]);

        $property->feature()->attach($request->features);
        $property->image()->attach($photoIds);

        Session::flash('success', 'Ваше объявление добавлено');

        return redirect()->route('index');
    }

    /**
     * If user has property resubmit it
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function resubmit( $id, Request $request ){
        if( Session::has('lang') ){
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }
            
        $property = Property::find($id);               
        $object_id = $request->object_id;            

        $photoNames = [];
        $photoIds = [];
    
        //If there is any change in the image(delete or upload)
        if( $request->has('changeInImage') ){
            $i = Image::count();
            $c = 0;            
            
            //if there was any image in propety grid, delete them physically and delete them in database
            if(!is_null($property->image()) && $property->image()->count() > 0){
                foreach( $property->image as $prop_image ){
                    File::delete(public_path( '/img/property_grid/' ) . $prop_image->name );
                    $prop_image->delete();
                }
            }
            $property->image()->detach();

            //if there is any image upload, move them from temp folder to property grid and update the table
            if(!is_null($request->img) && count($request->img) > 0 ){
                foreach( $request->img as $img ){

                    array_push($photoNames, $img);
                    Image::create([ 'id' => $i + 1, 'name' => $photoNames[$c] ]);
    
                    $new_path = public_path( '/img/unconfirm_upload/' ) . $photoNames[$c];
                    $old_path = public_path( '/img/property_grid/' ) . $photoNames[$c++];
    
                    File::move($new_path, $old_path);
    
                    $i++;
                    array_push($photoIds, $i);
                }
            }
        } else {
            //if there isn't any change in the images, delete all copied images from temp folder            
            if( !is_null($property->image()) && $property->image()->count() > 0 ){                
                foreach( $property->image as $imag ){
                    File::delete(public_path('/img/unconfirm_upload/') . $imag->name );
                }
            }
            
        }

        if( $object_id > 5 ){
            
            if( $object_id == 7 ){  $obj_area = $request->a_build;  } 
            else{ $obj_area = $request->tot_area;  }
            
            if( $request->sale_rent == 0 ){
                
                if($request->for_period == 1){
                    $rate = $request->price * 12;
                    $price = $request->price * $obj_area;
                }else{
                    $rate = $request->price;
                    $price = $request->price / 12 * $obj_area;
                }

            }else{
                
                $rate = $request->price / $obj_area;
                $price = $request->price;
            }

        }else{
            $price = $request->price;
            
            if( $request->sale_rent == 1 ){
                $rate = $request->price / $request->tot_area;
            }
        }
    
        for( $i = 1; $i < 20; $i++ ){
            if ($request->input('lat_' . $i) != null && $request->input('lng_' . $i) != null) {
                $lat = $request->input('lat_' . $i);
                $lng = $request->input('lng_' . $i);
            }
        }
    
        if( (!isset($lat)) && (!isset($lng)) ){
            $lat = $request->lat_db;
            $lng = $request->lng_db;
        }


        if( $object_id == 6 ){  $area = $request->a_build; } 
        else { $area = $request->tot_area; }
    
        if( $object_id == 1 ){  $title = $request->tot_rooms . '-ком. ' . ObjectNames::find($object_id)->name_ru . ' ' . $area . ' м²'; } 
        else {  $title = ObjectNames::find($object_id)->name_ru . ' ' . $area . ' м²'; }
    
        $this->checkEntry( $property->title, $title, 'title', $id );
        $this->checkEntry( $property->rooms, $request->tot_rooms, 'rooms', $id );
        $this->checkEntry( $property->type_id, $request->type_id, 'type_id', $id );
        $this->checkEntry( $property->city_id, $request->city, 'city_id', $id );
        $this->checkEntry( $property->velayat_id, $request->velayat, 'velayat_id', $id );
        $this->checkEntry( $property->address, $request->address, 'address', $id );
        $this->checkEntry( $property->price, ceil($price), 'price', $id );
        if( isset( $rate ) ){
            $this->checkEntry( $property->price_rate, ceil($rate), 'price_rate', $id );
        }
        $this->checkEntry( $property->lat, $lat, 'lat', $id );
        $this->checkEntry( $property->lng, $lng, 'lng', $id );
        $this->checkEntry( $property->area, $request->tot_area, 'area', $id );
        $this->checkEntry( $property->floor, $request->floor, 'floor', $id );
        $this->checkEntry( $property->floors_in_home, $request->tot_floor, 'floors_in_home', $id );
        $this->checkEntry( $property->land_area, $request->lArea, 'land_area', $id );
        if(!is_null($request->img) && count($request->img) > 0 ){             
            DB::table('properties')->where('id', $id)->update([ 'img' => str_replace('unconfirm_upload', 'property_grid', $request->mainImg) ]);
        } else {
            DB::table('properties')->where('id', $id)->update([ 'img' => asset('\img\property_grid\tm_default_image.jpg') ]);
        }
        $this->checkEntry( $property->land_area_type_id, $request->land_unit, 'land_area_type_id', $id );
        $this->checkEntry( $property->parking_id, $request->parking, 'parking_id', $id );
        $this->checkEntry( $property->parking_type_id, $request->park_type, 'parking_type_id', $id );
        $this->checkEntry( $property->bathroom_id, $request->bath, 'bathroom_id', $id );
        $this->checkEntry( $property->floor_material_id, $request->floor_mat, 'floor_material_id', $id );
        $this->checkEntry( $property->gates_id, $request->ent_gate, 'gates_id', $id );
        $this->checkEntry( $property->type_property_id, $request->t_house, 'type_property_id', $id );
        $this->checkEntry( $property->parking_spots, $request->place_num, 'parking_spots', $id );
        $this->checkEntry( $property->parking_spots_ex, $request->place_num_ex, 'parking_spots_ex', $id );
        $this->checkEntry( $property->sale_type_id, $request->sale_type, 'sale_type_id', $id );
        $this->checkEntry( $property->bonus_agent_id, $request->bonus_agent, 'bonus_agent_id', $id );
        $this->checkEntry( $property->tax_id, $request->tax, 'tax_id', $id );
        if( ($request->entry_free !== NULL && $request->entry_free !== '') || ($request->entry_free1 !== NULL && $request->entry_free1 !== '') ){
            $this->checkEntry( $property->parking_price, 0, 'parking_price', $id );
        }else {
            if( $request->cost !== NULL && $request->cost !== '' ){
                $this->checkEntry( $property->parking_price, $request->cost, 'parking_price', $id );
            } else {
                DB::table('properties')->where('id', $id)->update(['parking_price' => null]);
            }
        }
        $this->checkEntry( $property->rent_type_id, $request->rent_type, 'rent_type_id', $id );
        $this->checkEntry( $property->rent_term_id, $request->rent_period, 'rent_term_id', $id );
        $this->checkEntry( $property->ventilation_id, $request->vent_type, 'ventilation_id', $id );
        $this->checkEntry( $property->conditioning_id, $request->cond_type, 'conditioning_id', $id );
        $this->checkEntry( $property->heating_id, $request->heating, 'heating_id', $id );        
        $this->checkEntry( $property->firefighting_id, $request->fextin_type, 'firefighting_id', $id );
        $this->checkEntry( $property->building_type_id, $request->t_build, 'building_type_id', $id );
        $this->checkEntry( $property->entrance_id, $request->entry, 'entrance_id', $id );
        $this->checkEntry( $property->revamp_id, $request->decor, 'revamp_id', $id );
        $this->checkEntry( $property->office_repair_id, $request->layout, 'office_repair_id', $id );
        $this->checkEntry( $property->passenger_elevator, $request->pass_elevs, 'passenger_elevator', $id );
        $this->checkEntry( $property->service_elevator, $request->freight_elevs, 'service_elevator', $id );
        $this->checkEntry( $property->business_type_property_id, $request->property_type, 'business_type_property_id', $id );
        $this->checkEntry( $property->building_entrance_id, $request->building_entry, 'building_entrance_id', $id );
        $this->checkEntry( $property->trade_room_id, $request->t_premises, 'trade_room_id', $id );
        $this->checkEntry( $property->land_status_id, $request->land_status, 'land_status_id', $id );
        $this->checkEntry( $property->period_id, $request->for_period, 'period_id', $id );
        $this->checkEntry( $property->shop_window, $request->s_window, 'shop_window', $id );
        if( $request->undeposit ){ 
            $this->checkEntry( $property->without_collateral, 1, 'without_collateral', $id );
            DB::table('properties')->where('id', $id)->update([ 'deposit_payment' => null ]);
        } else {
            $this->checkEntry( $property->deposit_payment, $request->own_deposit, 'deposit_payment', $id );
            DB::table('properties')->where('id', $id)->update([ 'without_collateral' => null ]);
        }
        if( $request->open_24_hour ){
            $this->checkEntry( $property->from_dusk_till_dawn, 1, 'from_dusk_till_dawn', $id );
            DB::table('properties')->where('id', $id)->update([ 'from_hour' => null, 'to_hour' => null ]);
        } else {
            $this->checkEntry( $property->to_hour, $request->to_hour, 'to_hour', $id );
            $this->checkEntry( $property->from_hour, $request->from_hour, 'from_hour', $id );
            DB::table('properties')->where('id', $id)->update(['from_dusk_till_dawn' => null]);
        }
        $this->checkEntry( $property->day_week_id, $request->day_week, 'day_week_id', $id );
        $this->checkEntry( $property->village_name, $request->n_settlement, 'village_name', $id );
        $this->checkEntry( $property->elevator, $request->elevs, 'elevator', $id );
        $this->checkEntry( $property->trivalator, $request->travs, 'trivalator', $id );
        $this->checkEntry( $property->escalator, $request->escals, 'escalator', $id );
        $this->checkEntry( $property->prepayment, $request->prepayment, 'prepayment', $id );
        $this->checkEntry( $property->rent_part, $request->rent_part, 'rent_part', $id );
        $this->checkEntry( $property->living, $request->resid, 'living', $id );
        $this->checkEntry( $property->kitchen_area, $request->kitchen, 'kitchen_area', $id );
        $this->checkEntry( $property->trade_enabled, $request->barg_poss, 'trade_enabled', $id );
        $this->checkEntry( $property->land_owning_type_id, $request->land_type, 'land_owning_type_id', $id );
        $this->checkEntry( $property->comm_payment_included, $request->comm_payment, 'comm_payment_included', $id );
        $this->checkEntry( $property->explat_payment_included, $request->expl_payment, 'explat_payment_included', $id );
        $this->checkEntry( $property->min_term, $request->min_rent, 'min_term', $id );
        $this->checkEntry( $property->legal_address, $request->leg_add, 'legal_address', $id );
        $this->checkEntry( $property->occupied, $request->occ_room, 'occupied', $id );
        if( isset( $request->occ_room ) ){
            if( $request->occ_room == 1 ){
                $this->checkEntry( $property->occup_month_id, $request->occ_period_month, 'occup_month_id', $id );
                $this->checkEntry( $property->occup_year, $request->occ_period_year, 'occup_year', $id );
            } else {
                DB::table('properties')->where('id', $id)->update([ 'occup_month_id' => null, 'occup_year' => null ]);
            }
        }
        $this->checkEntry( $property->wet_points, $request->wet_points, 'wet_points', $id );
        $this->checkEntry( $property->price_unit_id, $request->price_unit, 'price_unit_id', $id );
        $this->checkEntry( $property->warehouse_service_elev, $request->freight, 'warehouse_service_elev', $id );
        $this->checkEntry( $property->warehouse_service_elev_cc, $request->freight_cap, 'warehouse_service_elev_cc', $id );
        $this->checkEntry( $property->warehouse_telfer_elev, $request->telpher, 'warehouse_telfer_elev', $id );
        $this->checkEntry( $property->warehouse_telfer_elev_cc, $request->telpher_cap, 'warehouse_telfer_elev_cc', $id );
        $this->checkEntry( $property->warehouse_passenger_elev, $request->passenger, 'warehouse_passenger_elev', $id );
        $this->checkEntry( $property->warehouse_passenger_elev_cc, $request->passenger_cap, 'warehouse_passenger_elev_cc', $id );
        $this->checkEntry( $property->warehouse_bridge_crane, $request->cr_over, 'warehouse_bridge_crane', $id );
        $this->checkEntry( $property->warehouse_bridge_crane_cc, $request->cr_over_cap, 'warehouse_bridge_crane_cc', $id );
        $this->checkEntry( $property->warehouse_balk_crane, $request->cr_beam, 'warehouse_balk_crane', $id );
        $this->checkEntry( $property->warehouse_balk_crane_cc, $request->cr_beam_cap, 'warehouse_balk_crane_cc', $id );
        $this->checkEntry( $property->warehouse_rail_crane, $request->cr_rail, 'warehouse_rail_crane', $id );
        $this->checkEntry( $property->warehouse_rail_crane_cc, $request->cr_rail_cap, 'warehouse_rail_crane_cc', $id );
        $this->checkEntry( $property->warehouse_goat_crane, $request->cr_gantry, 'warehouse_goat_crane', $id );
        $this->checkEntry( $property->warehouse_goat_crane_cc, $request->cr_gantry_cap, 'warehouse_goat_crane_cc', $id );
        $this->checkEntry( $property->line_house, $request->line_houses, 'line_house', $id );
        $this->checkEntry( $property->electric_power, $request->elec_pow, 'electric_power', $id );
        $this->checkEntry( $property->office_condition_id, $request->cond, 'office_condition_id', $id );
        $this->checkEntry( $property->furniture, $request->furniture, 'furniture', $id );
        $this->checkEntry( $property->equipment, $request->equip, 'equipment', $id );
        $this->checkEntry( $property->building_area, $request->a_build, 'building_area', $id );
        $this->checkEntry( $property->in_parts, $request->in_parts, 'in_parts', $id );
        $this->checkEntry( $property->construction_year, $request->const_year, 'construction_year', $id );
        $this->checkEntry( $property->ceil_height, $request->ceil, 'ceil_height', $id );
        $this->checkEntry( $property->animals_allowed, $request->with_animal, 'animals_allowed', $id );
        $this->checkEntry( $property->children_allowed, $request->with_child, 'children_allowed', $id );
        $this->checkEntry( $property->for_family, $request->for_family, 'for_family', $id );
        $this->checkEntry( $property->for_single, $request->for_single, 'for_single', $id );
        $this->checkEntry( $property->building_class, $request->c_build, 'building_class', $id );
        $this->checkEntry( $property->building_category, $request->category, 'building_category', $id );
        $this->checkEntry( $property->column_grid, $request->grid, 'column_grid', $id );
        $this->checkEntry( $property->monthly_profit, $request->mon_profit, 'monthly_profit', $id );
        $this->checkEntry( $property->apartment_type_id, $request->apart_type, 'apartment_type_id', $id );        
        $this->checkEntry( $property->house_patent, $request->patent, 'house_patent', $id);
        $this->checkEntry( $property->number_baths, $request->num_baths, 'number_baths', $id);
        $this->checkEntry( $property->room_layout_type, $request->room_layout, 'room_layout_type', $id);
        $this->checkEntry( $property->pool_in_building, $request->pool, 'pool_in_building', $id);
        $this->checkEntry( $property->house_purchase_status, $request->home_pur_debt, 'house_purchase_status', $id);
        $this->checkEntry( $property->house_purchase_debt_amount, $request->debt_amount, 'house_purchase_debt_amount', $id);
    
        if( $request->description != null ){
            $property->description()->update(['description' => $request->description]);
        }
        
        if( !is_null($request->ex_appoint) && $request->ex_appoint->count() > 0 ){
            ExtraBusinessType::where('property_id', $property->id)->delete();
            foreach( $request->ex_appoint as $appoint_ex ){
                ExtraBusinessType::create([ 'property_id' => $property->id, 'type' => $appoint_ex ]);
            }
        }    
        
        $property->feature()->detach();
        $property->feature()->attach($request->features);
        $property->image()->attach($photoIds);
        $property->infrastructure()->detach();
        $property->infrastructure()->attach($request->infras);
        $property->business_type()->detach();
        $property->business_type()->attach($request->appoint);
        $property->add_service()->attach($request->service);        
    
        Session::flash('success', __('messages.property_info_edited'));
        return redirect()->route('my_properties');
    }

    public function delete( $id ){
        $property = Property::find($id);

        $property->delete();

        Session::flash('success', 'Вы удалили объявление');

        return redirect()->back();
    }

    public function velayat_property( $id ){
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $properties = Property::where('accepted', 1)->where('velayat_id', $id)->orderBy('created_at', 'desc');
        $property_count = is_null($properties->get()) ? 0 : count($properties->get());
        
        return view('property.list')
            ->with('properties', $properties->paginate(8))
            ->with('selected_velayat', $id)
            ->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
            ->with('features', Feature::all())            
            ->with('revamps', Revamp::all())
            ->with('cities', City::all())            
            ->with('parkings', Parking::all())
            ->with('objects', ObjectNames::all())
            ->with('ads', Advertisement::where('active', 1)->get())
            ->with('conditions', OfficeCondition::all())
            ->with('build_appoints', BuildingType::all())
            ->with('infras', Infrastructure::all())
            ->with('r_types', RentType::all())
            ->with('buss_t_props', BusinessTypeProperty::all())
            ->with('st_props', LandOwningType::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('apartment_types', ApartmentType::all())
            ->with('buildings', Building::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('sale_types', SaleType::all())
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray())
            ->with('prop_count', $property_count);
    }


    public function type_property($id){
        
        if( Session::has('lang') ){
            App::setLocale(session('lang'));
        }else{
            App::setLocale('ru');
        }

        $properties = Property::where('accepted', 1)->where('type_id', $id)->orderBy('created_at', 'desc');
        $property_count = is_null($properties->get()) ? 0 : count($properties->get());

        $sel_obj=NULL;
        $sel_obj = $id == '1' ? 1 : 6; //if residantial option is selected in the main page => select the apartment object, otherwise => select the office option

        return view('property.list')
                ->with('properties', $properties->paginate(8))
                ->with('selected_object', $sel_obj)
                ->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
                ->with('features', Feature::all())                
                ->with('revamps', Revamp::all())
                ->with('cities',  City::all())
                ->with('parkings', Parking::all())
                ->with('objects', ObjectNames::all())
                ->with('ads', Advertisement::where('active', 1)->get())
                ->with('conditions', OfficeCondition::all())
                ->with('build_appoints', BuildingType::all())
                ->with('infras', Infrastructure::all())
                ->with('r_types', RentType::all())
                ->with('buss_t_props', BusinessTypeProperty::all())
                ->with('st_props', LandOwningType::all())
                ->with('trade_rooms', TradeRoom::all())
                ->with('apartment_types', ApartmentType::all())
                ->with('buildings', Building::all())
                ->with('floor_materials', FloorMaterial::all())            
                ->with('sale_types', SaleType::all())
                ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
                ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
                ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
                ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
                ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
                ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray())
                ->with('prop_count', $property_count);
    }

    public function main_Img($id, $n_name)
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }

        $prop_row = Property::find($id);

        $prop_row->mImg = $n_name;
        $prop_row->save();

        Session::flash('main_Image', 'Основное изображение было изменено!');

        return redirect()->back();

    }
    
    public function report_prop($id){
        
        if( Session::has('lang') ){
            App::setLocale(session('lang'));            
        }else{
            App::setLocale('ru');
        };

        return view('property.report')
            ->with('m_comps', Complaint::all())
            ->with('d_comps', ComplaintDetail::all())            
            ->with('id', $id);
    }

    public function complain(Request $request, $id){
        
        $this->validate($request, [
            'fullName' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        ListOfComplaints::create([
            'complaint_id' => $request->subject,
            'complaint_detail_id' => $request->detail,
            'name' => $request->fullName,
            'property_id' => $id,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        Mail::to('hello@example.com')->send(new ContactMail($request));

        Session::flash('complaint_success', 'Ваша жалоба отправлена на рассмотрение');
        return redirect()->route('index');
    }

    public function submit1(){
        
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $months_ru = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октября", "Ноябрь", "Декабрь"];
        $months_en = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $months_tm = ["Ýanwar", "Fewral", "Mart", "Aprel", "Maý", "Iýun", "Iýul", "Awgust", "Sentýabr", "Oktýabr", "Noýabr", "Dekabr"];

        $hide = true;        

        return view('property.submit1')
            ->with('accounts', accountType::all())
            ->with('deals', dealType::all())
            ->with('rents', typeRent::all())
            ->with('estates', typeEstate::all())
            ->with('building_types', BuildingType::all())
            ->with('conditioning', Conditioning::all())
            ->with('ventilation', Ventilation::all())
            ->with('heating', Heating::all())
            ->with('revamps', Revamp::all())
            ->with('rent_terms', RentTerm::all())
            ->with('parkings', Parking::all())
            ->with('parking_types', ParkingType::all())
            ->with('land_area_types', LandAreaType::all())
            ->with('office_repairs', OfficeRepair::all())
            ->with('office_conditions', OfficeCondition::all())
            ->with('periods', Period::all())
            ->with('land_owning_types', LandOwningType::all())
            ->with('gates', Gates::all())
            ->with('possible_apointments', PossibleAppointment::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('rent_types', RentType::all())
            ->with('business_types', BusinessType::all())
            ->with('land_statuses', LandStatus::all())
            ->with('business_types_property', BusinessTypeProperty::all())
            ->with('building_entrances', BuildingEntrance::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('entrances', Entrance::all())
            ->with('bathrooms', Bathroom::all())
            ->with('firefighting', Firefighting::all())
            ->with('infrastructure', Infrastructure::all())
            ->with('add_services', AddService::all())
            ->with('objects', typePropertyList::all())
            ->with('cities', City::all())
            ->with('taxes', Tax::all())
            ->with('velayats', Velayat::all())
            ->with('buildings', Building::all())
            ->with('sale_types', SaleType::all())
            ->with('bonus_agents', BonusAgent::all())
            ->with('features', Feature::all())
            ->with('apartment_types', ApartmentType::all())
            ->with('room_layouts', RoomLayout::all())
            ->with('site_settings', siteSetting::first())
            ->with('hide', $hide)
            ->with('months_ru', $months_ru)
            ->with('months_en', $months_en)
            ->with('months_tm', $months_tm)
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray());
    }

    public function loadImg(Request $request)
    {
        //$path = $request->file('file')->store(public_path());
        $photoName = time().'.' .$request->file->getClientOriginalName();
        $request->file->move(public_path('img/unconfirm_upload/'), $photoName);

        return response()->json($photoName);
    }

    public function deleteImg(Request $request)
    {
        //$path = $request->file('file')->store(public_path());
        $file = str_replace(URL::to('/') . '/img/unconfirm_upload/','',$request->url);
        $url = str_replace(URL::to('/'),'',$request->url);
        File::delete(public_path() . $url);
        return response()->json($file);
    }
    
    /* The function to check null and empty values, hence to control same values for updating edit form entries */
    public function checkEntry( $table_record, $form_record, $row_name, $id ){
        
        if( $table_record !== $form_record ){
            if( $form_record !== NULL || $form_record !== '' ) {
                DB::table('properties')->where('id', $id)->update([ $row_name => $form_record]);
            } else {
                DB::table('properties')->where('id', $id)->update([ $row_name => null]);
            }
        }

        return true;
    }

    public function checkFeatures($d_ids, $req_features){
        $prop_feat_ids = [];
        $new_feat_ids = [];
        $feature_cnt = is_null($req_features) ? 0 : count($req_features);

        for( $in_d=0; $in_d<count( $d_ids ); $in_d++ ){
            $prop_feat_ids = Property::find($d_ids[$in_d])->feature()->pluck('feature_id')->toArray();

            if( !is_null(array_intersect($req_features, $prop_feat_ids)) && count( array_intersect($req_features, $prop_feat_ids) ) == $feature_cnt ) {
                array_push( $new_feat_ids, $d_ids[$in_d] ); 
            }
        }
        return $new_feat_ids;
    }

    public function checkInfras($d_ids, $req_infras){

        $prop_infra_ids = [];
        $new_infra_ids = [];
        $infra_cnt = is_null($req_infras) ? 0 : count( $req_infras );
        
        for( $i=0; $i<count( $infra_cnt ); $i++){
            $prop_infra_ids = Property::find( $d_ids[$i] )->infrastructure()->pluck('infrastructure_id')->toArray();
            
            if(!is_null(array_intersect($req_infras, $prop_infra_ids)) && count( array_intersect($req_infras, $prop_infra_ids) ) == $infra_cnt ) {
                array_push( $new_infra_ids, $d_ids[$i] ); 
            }
        }
    }

    public function send_email_to_owner( $request, $id ){
        $request->validate([
            'full_name' => 'string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'message' => 'required'
        ]);

        $property = Property::find($id);
        $mail_reciever = $property->user->email;

        Mail::to( $mail_reciever )->send( new ContactMail( $request ) );
        Session::flash('success_ship', __('messages.success_ship'));
        return redirect()->back();
    }

    public function single_user_properties($user_id){
        if( Session::has('lang') ){
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $properties = Property::where('accepted', 1)        
                      ->where('user_id', $user_id);

        $property_count = is_null($properties->get()) ? 0 : count($properties->get());
        
        return view('property.list')
            ->with('properties', $properties->orderBy('created_at', 'desc')->paginate(8))
            ->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
            ->with('features', Feature::all())            
            ->with('revamps', Revamp::all())
            ->with('cities', City::all())
            ->with('types_' . $lang, Type::all())
            ->with('parkings', Parking::all())
            ->with('objects', ObjectNames::all())
            ->with('ads', Advertisement::where('active', 1)->get())
            ->with('conditions', OfficeCondition::all())
            ->with('build_appoints', BuildingType::all())
            ->with('infras', Infrastructure::all())
            ->with('r_types', RentType::all())
            ->with('buss_t_props', BusinessTypeProperty::all())
            ->with('st_props', LandOwningType::all())
            ->with('trade_rooms', TradeRoom::all())
            ->with('apartment_types', ApartmentType::all())
            ->with('buildings', Building::all())
            ->with('floor_materials', FloorMaterial::all())
            ->with('sale_types', SaleType::all())
            ->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray())
            ->with('prop_count', $property_count);
    }

    /**
	 * Bring the expired property into the active state for month
     * parametr property id and type of submission (1 => admin approve, 2 => user approve)
     * @return mixed
	 */
	public function property_return_expired($id, $type){

        if( Session::has('lang') ){
            App::setLocale(session('lang'));
            $lang = session('lang');
        } else {
            App::setLocale('ru');
            $lang = 'ru';
        }

        $property_row = Property::find($id);
        
		$property_row->expiring_at = Carbon::now('Asia/Ashgabat')->addMonth();
        $property_row->save();

        if( DB::table('users')->where('id',Auth::id())->pluck('admin')->first() ){
            $user = 'Администратор';
        } else {
            $user = $property_row->user->profile->first_name . ' ' . $property_row->user->profile->last_name;
        }

        AdminNotificationTable::create([
            'username' => $user,
            'title' => 'Объявление продлено',
            'message' => $id . '|' . $property_row->title
        ]);

        Session::flash('expired_reactivated', 'done');
        
        if( $type == 1 ){
            $all_properties = Property::all();		
            $properties = [];

            foreach($all_properties as $property){
                if ($property->expired()){
                    array_push($properties,$property);
                }
            }

            return view('admin.property.expired') 
                    ->with('properties', $properties)
                    ->with('types_ru', Type::all())
                    ->with('objects_ru', ObjectNames::all())
                    ->with( 'velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())                    
                    ->with('cities', City::all());
        } else {
            return view('user.my_properties')
                    ->with('properties', Property::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get());            
        }
    }
    

    public function related_properties($id) {

        $property = Property::find($id);
        $prop_owner_id = $property->user_id;

        $related_prop_flag = 0; //Property complete flag, 3 = related properties by the user, 2 => related properties all users, 1 => other properties, 0 => no properties at all
        $related_prop_ids = array((int)$id); //related property ids for later search in database
        $related_prop_temp_ids = array(); //temporary property ids, resulted from "$related_prop_query" query        
        $related_properties = null; //Initialize the related property array as null by default

        //Get all related properties by the "user"
        $related_prop_temp_ids = Property::where('accepted', 1)                                      
                                      ->where('user_id', $prop_owner_id)
                                      ->where('object_names_id', $property->object_names_id)
                                      ->where('saleOrRent', $property->saleOrRent)                                      
                                      ->whereNotIn('id', $related_prop_ids)
                                      ->take(6)
                                      ->pluck('id')
                                      ->toArray();
        
        if(count($related_prop_temp_ids) > 0 ) {

            $related_prop_ids = array_merge($related_prop_ids, $related_prop_temp_ids);
            if( count($related_prop_ids) === 7 ){
                //if complete, assign flag
                $related_prop_flag = 3;
            }
        }

        // If count of the related propeties by the "user" is less than 6, get all related properties by "all users"
        if( $related_prop_flag === 0 ){
            
            $related_prop_temp_ids = Property::where('accepted', 1)                                          
                                          ->where('object_names_id', $property->object_names_id)
                                          ->where('saleOrRent', $property->saleOrRent)                                          
                                          ->whereNotIn('id', $related_prop_ids)
                                          ->take(7 - count($related_prop_ids))
                                          ->pluck('id')
                                          ->toArray();
            
            if(count($related_prop_temp_ids) > 0 ){
                
                $related_prop_ids = array_merge($related_prop_ids, $related_prop_temp_ids);
                
                if( count($related_prop_ids) === 7 ){ 
                    $related_prop_flag = 2; 
                }
            }
        }

        // If count of the related properties by "all users" is less than 6, get other properties by "deal type" (sale or rent type) 
        if( $related_prop_flag === 0 ){
            
            $related_prop_temp_ids = Property::where('accepted', 1)
                                          ->where('saleOrRent', $property->saleOrRent)
                                          ->whereNotIn('id', $related_prop_ids)
                                          ->take(7 - count($related_prop_ids))
                                          ->pluck('id')
                                          ->toArray();
          
            if(count($related_prop_temp_ids) > 0 ){
                
                $related_prop_ids = array_merge($related_prop_ids, $related_prop_temp_ids);

                if( count($related_prop_ids) === 7 ){ 
                    $related_prop_flag = 1; 
                }
            }
        }

        // If count of the other properties by "deal type" is less than 6, get other properties by "object type" (ex: rent and sale apartment)
        if( $related_prop_flag === 0 ){
            $related_prop_temp_ids = Property::where('accepted', 1)                                          
                                          ->where('object_names_id', $property->object_names_id)
                                          ->whereNotIn('id', $related_prop_ids)
                                          ->take(7 - count($related_prop_ids))
                                          ->pluck('id')
                                          ->toArray();
            
            if(count($related_prop_temp_ids) > 0 ){

                $related_prop_ids = array_merge($related_prop_ids, $related_prop_temp_ids);
                
                if( count($related_prop_ids) === 7 ){ 
                    $related_prop_flag = 1; 
                }
            }
        }
        
               
        //if count of the other properties by "object type" is less than 6, get other properties by "type id", 1 => for residential property, 2 => for commercial property
        if( $related_prop_flag === 0 ){
            $related_prop_temp_ids = Property::where('accepted', 1)                                          
                                          ->where('type_id', $property->type_id)                                          
                                          ->whereNotIn('id', $related_prop_ids)
                                          ->take(7 - count($related_prop_ids))
                                          ->pluck('id')
                                          ->toArray();

            if( count($related_prop_temp_ids) > 0 ){

                $related_prop_ids = array_merge($related_prop_ids, $related_prop_temp_ids);
                
                if( count($related_prop_ids) === 7 ){ 
                    $related_prop_flag = 1; 
                }
            }
        }
        

        //if count of the other properties by "type id" is less than 6, get all properties in the table
        if( $related_prop_flag === 0 ){
            $related_prop_temp_ids = Property::where('accepted', 1)
                                          ->whereNotIn('id', $related_prop_ids)
                                          ->take(7 - count($related_prop_ids))
                                          ->pluck('id')
                                          ->toArray();

            if( count($related_prop_temp_ids) > 0 ){
                $related_prop_ids = array_merge($related_prop_ids, $related_prop_temp_ids);
            }

            $related_prop_flag = 1;
        }

        array_push($related_prop_ids, $related_prop_flag);
        return $related_prop_ids;
    }
}