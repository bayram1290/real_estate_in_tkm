<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function api_properties($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Property::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_users($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\User::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_objects($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\ObjectNames::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_cities($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\City::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_velayats($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Velayat::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_ads($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Advertisement::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_bathrooms($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Bathroom::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_buildings($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Building::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_building_types($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\BuildingType::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_business_types($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\BusinessType::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_features($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Feature::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_rent_terms($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\RentTerm::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_rent_types($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\RentType::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_profiles($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Profile::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_periods($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Period::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_ventilations($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Ventilation::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_taxes($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Tax::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_revamps($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Revamp::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_infrastructures($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Infrastructure::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_conditioning($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Conditioning::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_entrances($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Entrance::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_floor_materials($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\FloorMaterial::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_types($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Type::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_possible_appointments($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\PossibleAppointment::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_office_conditions($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\OfficeCondition::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_office_repairs($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\OfficeRepair::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_gates($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Gates::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_heating($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Heating::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_firefighting($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Firefighting::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_newsletters($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Firefighting::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_add_services($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\AddService::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_bonus_agents($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\BonusAgent::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_building_entrances($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\BuildingEntrance::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_business_types_property($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\BusinessTypeProperty::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_day_week($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\DayWeek::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_parkings($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\Parking::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_parking_types($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\ParkingType::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_trade_rooms($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\TradeRoom::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }

    public function api_property_descriptions($apiKey)
    {
        $get_key = \App\ApiKeys::where('key',$apiKey)->first();
        if (count($get_key) > 0){
            if (\Carbon\Carbon::now()->lessThan($get_key->expirationDate)){
                $access = true;
            }
            else{
                $access = false;
            }
        }
        else{
            $access = false;
        }

        if ($access){
            return response()->json(\App\PropertyDescription::all());
        }
        else{
            return 'Ключ API неверен';
        }
    }



}
