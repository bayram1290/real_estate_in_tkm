<?php

namespace App\Http\Controllers;

use File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\ExtraBusinessType;
use App\ExtraPossibleAppointments;
use App\ObjectNames;
use App\Image;
use App\City;
use App\Property;
use App\PropertyDescription;
use App\propertyObjectType;
use Carbon\Carbon;

class CreatePropertyControllerTest extends Controller {
    public function create( Request $request ){

        if( Session::has('lang') ){ 
            App::setLocale(session('lang'));
            $lang = session('lang'); 
        } else { 
            App::setLocale('ru');
            $lang = 'ru';
        }

        $type_id = $request->type_id;
        $object_id = $request->object_id;
        $saleRent = $request->sale_rent;
        $ob_types_ru = propertyObjectType::pluck('name_ru')->toArray();
        $ob_types_en = propertyObjectType::pluck('name_en')->toArray();
        $ob_types_tm = propertyObjectType::pluck('name_tm')->toArray();
        
        $photoNames = [];
        $photoIds = [];
        
        if( $request->img ) {
            
            $i = Image::count();
            $c = 0;                      

            foreach( $request->img as $img ){
                array_push($photoNames, $img);

                Image::create([ 'id' => $i + 1, 'name' => $photoNames[$c] ]);

                $n_path =  public_path('img/unconfirm_upload/') . $photoNames[$c];
                $o_path = public_path('img/property_grid/') . $photoNames[$c++];
                
                File::move($n_path, $o_path);

                $i++;                
                array_push($photoIds, $i);
            }
        }

        if( $object_id == 6 ){ $area = $request->a_build; } 
        else { $area = $request->tot_area; }

        for( $i = 1; $i < 21; $i++ ){
            if( $request->input('lat_'. $i) != null && $request->input('lng_'. $i) != null ){
                $lat = $request->input('lat_'. $i);
                $lng = $request->input('lng_'. $i);
            }
        }

        if( (!isset($lat)) && (!isset($lng)) ){
            $lat = '37.9601';
            $lng = '58.3261';
        }


        if( $lang == 'ru' || $lang == 'tm'){
            //Object title assingment starts
            $title = $saleRent == 0 ? __('messages.rent') : __('messages.sale');
            
            if( $lang == 'ru') {
                $title = $title . ' ' . $ob_types_ru[$object_id - 1] . ' - ';
            }else {
                $title = $title . ' ' . $ob_types_tm[$object_id - 1] . ' - ';
            }

            /* if object is residential */
            if( $type_id == 1 ){
                // Apartment
                if( $object_id < 3 ){
                    if( (int)$request->tot_rooms == 7 ){
                        $title = $title . __('messages.free_layout') . ', ';
                    }elseif( (int)$request->tot_rooms == 8 ){
                        $title = $title . __('messages.studio') . ', ';
                    }else{
                        $title = $title . $request->tot_rooms. '-' . __('messages.room_sh1') . ', ';
                    }
                    $title = $title . $request->floor . '/' . $request->tot_floor . ' ' . __('messages.floor') . ', ';
                }elseif( $object_id == 5 ){
                    // Part of house
                    $title = $title .  $request->rent_part . ' ' . __('messages.part') . ', ';
                    if( $request->tot_floor !== NULL && $request->tot_floor !== '' ){
                        $title = $title . $request->tot_floor . ' ' . mb_strtolower(__('messages.floor'), 'UTF-8') . ', ';
                    }                    
                }else{
                    // House and cottage
                    if( $request->tot_rooms !== NULL && $request->tot_rooms !== '' ){
                        $title = (int)$request->tot_rooms == 7 ? $title . '7 +' : $title . $request->tot_rooms;
                        $title = $title . ' ' . __('messages.room_sh3') . ', ';
                    }
                    if( $request->tot_floor !== NULL && $request->tot_floor !== '' ){
                        $title = $title . $request->tot_floor . ' ' . mb_strtolower(__('messages.floor'), 'UTF-8') . ', ';
                    }                    
                }                
            }else{
                /* if object is commercial */

                if( $object_id == 6 || $object_id == 8 ){
                    // office or outlet point
                    $title = $title . $request->floor . '/' . $request->tot_floor . ' ' . __('messages.floor') . ' , ';
                }elseif( $object_id == 7 ){
                    $title = $title . $request->tot_floor . ' ' . mb_strtolower(__('messages.floor'), 'UTF-8') . ', ';

                    if( $request->c_build !== NULL && $request->c_build !== '' ){
                        $title = $title . $request->c_build . ' ' . mb_strtolower(__('messages.build_class'), 'UTF-8') . ', ';
                    }
                } 
            }

            $title = $title . $request->tot_area . ' ' . __('messages.meter') . __('messages.sqr_sym');
            
        }elseif($lang == 'en'){
            
        }

        
        //Object title assingment ends
        
        $property = Property::create([
            'accepted' => 0,
            'title' => $title,                        
            'type_id' => $type_id,
            'object_names_id' => $object_id,
            'velayat_id' => $request->velayat,
            'city_id' => $request->city,
            'address' => $request->address,
            'user_id' => Auth::id(),
            'profile_id' => Auth::user()->profile->id,
            'featured' => 0,
            'saleOrRent' => $saleRent,
            'expiring_at' => Carbon::now('Asia/Ashgabat')->addMonth(),
            'lat' => $lat,
            'lng' => $lng,                        
            'price_unit_id' => $request->price_unit            
        ]);

        
        
        $property_id = $property->id;

        if( $request->object_id > 5 ){
            
            if( $request->object_id == 7 ){  $obj_area = $request->a_build; } 
            else {  $obj_area = $request->tot_area; }
            
            if( $request->sale_rent == 0 ){
                
                if($request->for_period == 1){
                    $rate = $request->price * 12;
                    $price = $request->price * $obj_area;
                }else{
                    $rate = $request->price;
                    $price = ($request->price / 12) * $obj_area;
                }

            } else {
                
                $rate = $request->price / $obj_area;
                $price = $request->price;
            }

        }else{
            $price = $request->price;
            
            if( $request->sale_rent == 1 ){
                $rate = $request->price / $request->tot_area;
            }
        }

        $property->price = round( $price, 2 );
        
        
        if( isset( $rate ) ){
            $property->price_rate = round($rate, 2);
        }

        if($request->floor !== NULL && $request->floor !== ''){
            $property->floor = $request->floor;
        }

        if($request->decor !== NULL && $request->decor !== ''){
            $property->revamp_id = $request->decor;
        }

        if($request->bath !== NULL && $request->bath !== ''){
            $property->bathroom_id = $request->bath;
        }

        if($request->land_unit !== NULL && $request->land_unit !== ''){
            $property->land_area_type_id = $request->land_unit;
        }
        
        if($request->barg_poss !== NULL && $request->barg_poss !== ''){
            $property->trade_enabled = $request->barg_poss;
        }

        if($request->rent_period !== NULL && $request->rent_period !== ''){
            $property->rent_term_id = $request->rent_period;
        }

        if($request->rent_part !== NULL && $request->rent_part !== ''){
            $property->rent_part = $request->rent_part;
        }

        if($request->cond !== NULL && $request->cond !== ''){
            $property->office_condition_id = $request->cond;
        }
        
        if($request->layout !== NULL && $request->layout !== ''){
            $property->office_repair_id = $request->layout;
        }

        if($request->for_period !== NULL && $request->for_period !== ''){
            $property->period_id = $request->for_period;
        }

        if($request->land_type !== NULL && $request->land_type !== ''){
            $property->land_owning_type_id = $request->land_type;
        }

        if($request->land_type1 !== NULL && $request->land_type1 !== ''){
            $property->land_owning_type_id = $request->land_type1;
        }

        if($request->vent_type !== NULL && $request->vent_type !== ''){
            $property->ventilation_id = $request->vent_type;
        }

        if($request->cond_type !== NULL && $request->cond_type !== ''){
            $property->conditioning_id = $request->cond_type;
        }

        if($request->fextin_type !== NULL && $request->fextin_type !== ''){
            $property->firefighting_id = $request->fextin_type;
        }
        
        if($request->t_premises !== NULL && $request->t_premises !== ''){
            $property->trade_room_id = $request->t_premises;
        }

        if($request->property_type !== NULL && $request->property_type !== ''){
            $property->business_type_property_id = $request->property_type;
        }
         
        if($request->sale_type !== NULL && $request->sale_type !== ''){
            $property->sale_type_id = $request->sale_type;
        }

        if($request->pass_elevs !== NULL && $request->pass_elevs !== ''){
            $property->passenger_elevator = $request->pass_elevs;
        }

        if($request->freight_elevs !== NULL && $request->freight_elevs !== ''){
            $property->service_elevator = $request->freight_elevs;
        }

        if($request->bonus_agent !== NULL && $request->bonus_agent !== ''){
            $property->bonus_agent_id = $request->bonus_agent;
        }

        if($request->tot_area !== NULL && $request->tot_area !== ''){
            $property->area = $request->tot_area;
        }

        if($request->tot_rooms !== NULL && $request->tot_rooms !== ''){
            $property->rooms = $request->tot_rooms;
        }

        if($request->lArea !== NULL && $request->lArea !== ''){
            $property->land_area = $request->lArea;
        }

        if($request->resid !== NULL && $request->resid !== ''){
            $property->living = $request->resid;
        }

        if($request->kitchen !== NULL && $request->kitchen !== ''){
            $property->kitchen_area = $request->kitchen;
        }

        if($request->with_animal !== NULL && $request->with_animal !==''){
            $property->animals_allowed = $request->with_animal;
        }

        if($request->with_child !== NULL && $request->with_child !== ''){
            $property->children_allowed = $request->with_child;
        }

        if($request->for_family !== NULL && $request->for_family !== ''){
            $property->for_family = $request->for_family;
        }
        
        if($request->for_single !== NULL && $request->for_single !== ''){
            $property->for_single = $request->for_single;
        }

        if($request->const_year !== NULL && $request->const_year !== ''){            
            $property->construction_year = $request->const_year;
        }

        if($request->ceil !== NULL && $request->ceil !== ''){
            $property->ceil_height = $request->ceil;
        }

        if($request->t_house !== NULL && $request->t_house !== ''){
            $property->type_property_id = $request->t_house;
        }

        if($request->parking !== NULL && $request->parking !== ''){
            $property->parking_id = $request->parking;
        }

        if($request->own_deposit !== NULL && $request->own_deposit !== ''){
            $property->deposit_payment = $request->own_deposit;
        }

        if($request->prepayment !== NULL && $request->prepayment !== ''){
            $property->prepayment = $request->prepayment;
        }
        
        if($request->undeposit !== NULL && $request->undeposit !== ''){
            $property->without_collateral = 1;
        }
        
        if($request->tot_floor !== NULL && $request->tot_floor !== ''){
            $property->floors_in_home = $request->tot_floor;
        }


        if($request->num_beds !== NULL && $request->num_beds !== ''){
            $property->num_beds = $request->num_beds;
        }

        if($request->heating !== NULL && $request->heating !== ''){
            $property->heating_id = $request->heating;
        }

        if($request->cost !== NULL && $request->cost !== ''){
            $property->parking_price = $request->cost;
        }

        if( ($request->entry_free !== NULL && $request->entry_free !== '') || ($request->entry_free1 !== NULL && $request->entry_free1 !== '') ) {
            $property->parking_price = 0;
        }
        
        if($request->t_build !== NULL && $request->t_build !== '') {
            $property->building_type_id = $request->t_build;
        }

        if($request->in_parts !== NULL && $request->in_parts !== '') {
            $property->in_parts = $request->in_parts;
        }

        if($request->leg_add !== NULL && $request->leg_add !== '') {
            $property->legal_address = $request->leg_add;
        }

        if($request->occ_room !== NULL && $request->occ_room !== '') {
            $property->occupied = $request->occ_room;
            
            if( $request->occ_room == 1 ){
                $property->occup_month_id = $request->occ_period_month;
                $property->occup_year = $request->occ_period_year;
            }
        }

        if($request->wet_points !== NULL && $request->wet_points !== '') {
            $property->wet_points = $request->wet_points;
        }

        if($request->elec_pow !== NULL && $request->elec_pow !== '') {
            $property->electric_power = $request->elec_pow;
        }

        if($request->furniture !== NULL && $request->furniture !== '') {
            $property->furniture = $request->furniture;
        }

        if($request->place_num !== NULL && $request->place_num !== '') {
            $property->parking_spots = $request->place_num;
        }

        if($request->place_num_ex !== NULL && $request->place_num_ex !== '') {
            $property->parking_spots_ex = $request->place_num_ex;
        }

        if($request->a_build !== NULL && $request->a_build !== '') {
            $property->building_area = $request->a_build;
        }

        if($request->rent_type !== NULL && $request->rent_type !== '') {
            $property->rent_type_id = $request->rent_type;
        }

        if($request->min_rent !== NULL && $request->min_rent !== '') {
            $property->min_term = $request->min_rent;
        }

        if($request->line_houses !== NULL && $request->line_houses !== '') {
            $property->line_house = $request->line_houses;
        }

        if($request->c_build !== NULL && $request->c_build !== '') {
            $property->building_class = $request->c_build;
        }
        
        if($request->entry !== NULL && $request->entry !== '') {
            $property->entrance_id = $request->entry;
        }

        if($request->building_entry !== NULL && $request->building_entry !== '') {
            $property->building_entrance_id = $request->building_entry;
        }

        if($request->elevs !== NULL && $request->elevs !== '') {
            $property->elevator = $request->elevs;
        }

        if($request->travs !== NULL && $request->travs !== '') {
            $property->trivalator = $request->travs;
        }

        if($request->escals !== NULL && $request->escals !== '') {
            $property->escalator = $request->escals;
        }

        if($request->s_window !== NULL && $request->s_window !== '') {
            $property->shop_window = $request->s_window;
        }

        if($request->open_24_hour !== NULL && $request->open_24_hour !== '') {
            $property->from_dusk_till_dawn = $request->open_24_hour;
        }else{

            if($request->from_hour !== NULL && $request->from_hour !== '') {
                $property->from_hour = $request->from_hour;
            }
    
            if($request->to_hour !== NULL && $request->to_hour !== '') {
                $property->to_hour = $request->to_hour;
            }

        }

        if($request->day_week !== NULL && $request->day_week !== '') {
            $property->day_week_id = $request->day_week;
        }

        if($request->floor_mat !== NULL && $request->floor_mat !== '') {
            $property->floor_material_id = $request->floor_mat;
        }

        if($request->ent_gate !== NULL && $request->ent_gate !== '') {
            $property->gates_id = $request->ent_gate;
        }

        if($request->park_type !== NULL && $request->park_type !== '') {
            $property->parking_type_id = $request->park_type;
        }

        if($request->equip !== NULL && $request->equip !== '') {
            $property->equipment = $request->equip;
        }

        if($request->tax !== NULL && $request->tax !== '') {
            $property->tax_id = $request->tax;
        }

        if($request->grid !== NULL && $request->grid !== '') {
            $property->column_grid = $request->grid;
        }

        if($request->freight !== NULL && $request->freight !== '') {
            $property->warehouse_service_elev = $request->freight;
        }

        if($request->freight_cap !== NULL && $request->freight_cap !== '') {
            $property->warehouse_service_elev_cc = $request->freight_cap;
        }

        if($request->telpher !== NULL && $request->telpher !== '') {
            $property->warehouse_telfer_elev = $request->telpher;
        }

        if($request->telpher_cap !== NULL && $request->telpher_cap !== '') {
            $property->warehouse_telfer_elev_cc = $request->telpher_cap;
        }
        
        if($request->passenger !== NULL && $request->passenger !== '') {
            $property->warehouse_passenger_elev = $request->passenger;
        }
        
        if($request->passenger_cap !== NULL && $request->passenger_cap !== '') {
            $property->warehouse_passenger_elev_cc = $request->passenger_cap;
        }

        if($request->cr_over !== NULL && $request->cr_over !== '') {
            $property->warehouse_bridge_crane = $request->cr_over;
        }

        if($request->cr_over_cap !== NULL && $request->cr_over_cap !== '') {
            $property->warehouse_bridge_crane_cc = $request->cr_over_cap;
        }

        if($request->cr_beam !== NULL && $request->cr_beam !== '') {
            $property->warehouse_balk_crane = $request->cr_beam;
        }

        if($request->cr_beam_cap !== NULL && $request->cr_beam_cap !== '') {
            $property->warehouse_balk_crane_cc = $request->cr_beam_cap;
        }

        if($request->cr_rail !== NULL && $request->cr_rail !== '') {
            $property->warehouse_rail_crane = $request->cr_rail;
        }

        if($request->cr_rail_cap !== NULL && $request->cr_rail_cap !== '') {
            $property->warehouse_rail_crane_cc = $request->cr_rail_cap;
        }

        if($request->cr_gantry !== NULL && $request->cr_gantry !== '') {
            $property->warehouse_goat_crane = $request->cr_gantry;
        }

        if($request->cr_gantry_cap !== NULL && $request->cr_gantry_cap !== '') {
            $property->warehouse_goat_crane_cc = $request->cr_gantry_cap;
        }

        if($request->mon_profit !== NULL && $request->mon_profit !== '') {
            $property->monthly_profit = $request->mon_profit;
        }

        if($request->n_settlement !== NULL && $request->n_settlement !== '') {
            $property->village_name = $request->n_settlement;
        }

        if($request->mainImg !== NULL && $request->mainImg !== '') {
            $property->img = str_replace('unconfirm_upload', 'property_grid', $request->mainImg);
        }

        if($request->comm_payment !== NULL && $request->comm_payment !== '') {
            $property->comm_payment_included = $request->comm_payment;
        }

        if($request->expl_payment !== NULL && $request->expl_payment !== '') {
            $property->explat_payment_included = $request->expl_payment;
        }

        if($request->land_status !== NULL && $request->land_status !== '') {
            $property->land_status_id = $request->land_status;
        }
        
        if($request->category !== NULL && $request->category !== '') {
            $property->building_category = $request->category;
        }

        if($request->apart_type !== NULL && $request->apart_type !== '') {
            $property->apartment_type_id = $request->apart_type;
        }

        if($request->patent !== NULL && $request->patent !== ''){
            $property->house_patent = $request->patent;
        }

        if($request->num_baths !== NULL && $request->num_baths !== ''){
            $property->number_baths = $request->num_baths;
        }

        if($request->room_layout !== NULL && $request->room_layout !== ''){
            $property->room_layout_type = $request->room_layout;
        }
        
        if($request->pool !== NULL && $request->pool !== ''){
            $property->pool_in_building = $request->pool;
        }

        if($request->home_pur_debt !== NULL && $request->home_pur_debt !== ''){
            $property->house_purchase_status = $request->home_pur_debt;
        }

        if( $request->debt_amount !== NULL && $request->debt_amount !== '' && $request->home_pur_debt === '2'){
            $property->house_purchase_debt_amount = $request->debt_amount;
        }        

        PropertyDescription::create([
            'description' => $request->description,
            'property_id' => $property->id
        ]);
        
        if ($request->has('ex_appoint') && count($request->ex_appoint) > 0){
            foreach ($request->ex_appoint as $appoint_ex){
                ExtraBusinessType::create([ 'property_id' => $property->id, 'type' => $appoint_ex ]);
            }
        }
        
        $property->feature()->attach($request->features);
        $property->image()->sync($photoIds);
        $property->add_service()->attach($request->service);
        $property->infrastructure()->attach($request->infras);
        $property->business_type()->attach($request->appoint);        
        $property->save();
                
        Session::flash('add_property', __('messages.your_announcement'));
        return redirect()->back();
    }
}
