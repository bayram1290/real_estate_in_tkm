<?php

namespace App\Http\Controllers;

use File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App;
use App\Property;
use App\Type;
use App\Profile;
use App\City;
use App\ObjectNames;
use App\Feature;
use App\Image;
use App\AddService;
use App\Advertisement;
use App\Bathroom;
use App\BonusAgent;
use App\Building;
use App\BuildingEntrance;
use App\BuildingType;
use App\BusinessType;
use App\BusinessTypeProperty;
use App\Conditioning;
use App\Entrance;
use App\Firefighting;
use App\FloorMaterial;
use App\Gates;
use App\Heating;
use App\Infrastructure;
use App\LandAreaType;
use App\LandOwningType;
use App\LandStatus;
use App\ListOfComplaints;
use App\OfficeCondition;
use App\OfficeRepair;
use App\Parking;
use App\ParkingType;
use App\Period;
use App\PossibleAppointment;
use App\PropertyDescription;
use App\RentTerm;
use App\RentType;
use App\Revamp;
use App\SaleType;
use App\Tax;
use App\TradeRoom;
use App\TypeProperty;
use App\Velayat;
use App\Ventilation;
use App\Complaint;
use App\ComplaintDetail;
use App\accountType;
use App\dealType;
use App\typeRent;
use App\typeEstate;
use App\typePropertyList;
use Illuminate\Support\Facades\Hash;
use App\ExtraBusinessType;
use App\ApartmentType;
use App\RoomLayout;

class UserController extends Controller
{
    public function my_properties()
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }

        $properties = Property::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('user.my_properties')->with('properties', $properties);
    }

    public function edit_page($id)
    {

        if( Session::has('lang') ){
            App::setLocale(session('lang'));
            $lang = session('lang');
        }else{
            App::setLocale('ru');
            $lang = 'ru';
        }

        $property = Property::find($id);
        $types = Type::all('name_' . $lang, 'id');
        $objects = ObjectNames::all();
        $cities = City::all();
        $features = Feature::all();
        $hide = false;

        $price_rate = $property->price_rate;

        if( $property->object_names_id > 5 && $property->period_id == 1 ){
            $price_rate /= 12;
        }

        $months_ru = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октября", "Ноябрь", "Декабрь"];
        $months_en = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $months_tm = ["Ýanwar", "Fewral", "Mart", "Aprel", "Maý", "Iýun", "Iýul", "Awgust", "Sentýabr", "Oktýabr", "Noýabr", "Dekabr"];
        
        if( $property->image()->count() > 0 ){
            foreach( $property->image as $c_img ){                
                File::copy( public_path('\\img\\property_grid\\') . $c_img->name, public_path('\\img\\unconfirm_upload\\') . $c_img->name );
            }
        }

        return view('user.edit_property')
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
            ->with('property', $property)
            ->with('extra_possible_business_types', ExtraBusinessType::where('property_id', $id)->get())
            ->with('apartment_types', ApartmentType::all())
            ->with('room_layouts', RoomLayout::all())
            ->with('hide', $hide)
            ->with('months_ru', $months_ru)
            ->with('months_en', $months_en)
            ->with('months_tm', $months_tm)
            ->with('price_rate', $price_rate);
    }

    public function edit_property($id)
    {
        $property = Property::find($id);

        if (Session::has('lang')) {
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }

        $this->validate(request(), [
            'title' => 'required',
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'rooms' => 'required|numeric|between:1,10',
            'description' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if (request()->hasFile('img')) {
            $i = Image::count();
            foreach (request()->img as $img) {
                array_push($photoNames, time() . '.' . $img->getClientOriginalExtension());

                $img->move(public_path('img/property_grid'), $photoNames[$i]);

                Image::create([
                    'id' => $i + 1,
                    'name' => $photoNames[$i]
                ]);
                $i++;
                array_push($photoIds, $i);
            }
            $property->img = 'img/property_grid/' . $photoNames[0];
            $property->img()->sync(request()->img);
        }

        $property->title = request()->title;
        $property->saleOrRent = request()->status;
        $property->type_id = request()->type;
        $property->object_names_id = request()->object;
        $property->area = request()->area;
        $property->rooms = request()->rooms;
        $property->price = request()->price;
        $property->address = request()->address;
        $property->address = request()->balcony;
        $property->pass_lift = request()->pass_lift;
        $property->service_lift = request()->service_lift;
        $property->city_id = request()->city;
        $property->lat = request()->lat;
        $property->lng = request()->lng;
        $property->floor = request()->floor;
        $property->floors_in_home = request()->floors_in_home;
        $property->toilets = request()->toilets;
        $property->revamp_id = request()->repair;
        $property->type_of_toilets = request()->toilet_type;

        if (!empty(request()->features)) {
            $property->featured = 1;
        } else {
            $property->featured = 0;
        }

        $property->feature()->sync(request()->features);

        $property->save();

        return redirect()->route('profile.user');
    }

    public function change_pswd()
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }

        return view('user.change_pswd');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }

}
