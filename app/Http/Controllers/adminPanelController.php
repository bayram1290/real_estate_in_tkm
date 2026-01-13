<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\ApiKeys;
use App\Documents;
use App\ListOfComplaints;
use App\Profile;

use App\Property;
use App\Type;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\adminProfile;
use App\User;
use Auth;
use App\siteSetting;
use App\City;
use App\Velayat;
use App\Feature;
use App\Image;
use Carbon\Carbon;
use App\ObjectNames;
use Illuminate\Support\Facades\File;
use Psy\Util\Str;
use App\AdminNotificationTable;

use App\propertyDealType;
use App\propertyObjectType;
use App\ApartmentType;
use App\Revamp;
use App\Building;
use App\Parking;
use App\SaleType;
use App\RoomLayout;
use App\Bathroom;
use App\LandAreaType;
use App\RentTerm;
use App\Heating;
use App\LandStatus;
use App\BonusAgent;
use App\OfficeRepair;
use App\OfficeCondition;
use App\Entrance;
use App\BuildingType;
use App\Ventilation;
use App\Conditioning;
use App\Firefighting;
use App\LandOwningType;
use App\RentType;
use App\Tax;
use App\BuildingEntrance;
use App\TradeRoom;
use App\ExtraBusinessType;
use App\Gates;
use App\FloorMaterial;
use App\ParkingType;
use App\BusinessTypeProperty;

class adminPanelController extends Controller
{
    /**
	 * Admin Dashboard
	 */
	public function dashboard() {
		$pending_properties = Property::where('accepted', 0)->get();
		$recent_properties = Property::orderBy('created_at','desc')->take(4)->get();
		$cnt_notifs = count(AdminNotificationTable::all());

		return view( 'admin.dashboard' )
				->with('pending_properties',$pending_properties)
				->with('recent_properties',$recent_properties)
				->with('notifications', AdminNotificationTable::orderBy('created_at','desc')->take(3)->get())
				->with('cnt_notifs', $cnt_notifs);
    }
    
    /**
	 * Admin profile
	 * @return mixed
	 */
	public function admin_profile(){
		$user_row = User::where('admin','1')->first();
		$profiles = adminProfile::where('user_id', $user_row->id)->first();
		$phone=preg_replace('/\s+/', '', $user_row->phone);
		$phone=substr($phone, 0, 4) .' (' . substr($phone, 4, 2) . ') '. substr($phone, 6, 2) . ' ' . substr($phone, 8, 2) . ' '. substr($phone, 10, 2);
		$w_phone = preg_replace('/\s+/', '', $profiles->work_phone);
		$w_phone=substr($w_phone, 0, 4) .' (' . substr($w_phone, 4, 2) . ') '. substr($w_phone, 6, 2) . ' ' . substr($w_phone, 8, 2) . ' '. substr($w_phone, 10, 2);
		return view('admin.admin_profile')->with('user', Auth::user())->with('username', $user_row->name)->with('email', $user_row->email)->with('phone', $phone)->with('profile_info', $profiles)->with('w_phone', $w_phone);
    }
    
    /**
	 * Updating Profile
	 * */
	public function admin_profile_update(Request $request){

		$this->validate($request, [
			'name' => 'required|string|max:50',
			'fname' => 'string|max:255',
			'phone' => 'required',
		]);

		$user = Auth::user();
		if($request->email!== $user->email){ $this->validate($request, [ 'email' => 'required|string|email|max:255|unique:users', ]); }

		if(!$request->password == ''){
			$this->validate($request, [
				'password' => 'required|confirmed',
				'password_confirmation' => 'required|required_with:password',
			]);

			$user->password = bcrypt($request->password);
		}

		if($request->hasFile('avatar')){
			$new_img = $request->avatar;
			$new_img_name = time().$new_img->getClientOriginalName();
			$new_img->move('images/dashboard/users', $new_img_name);
			$user->admin_profile->avatar='images/dashboard/users/'.$new_img_name;
		}

		$user->name = $request->name;
		$user->email= $request->email;
		$user->phone= $request->phone;

		if(!$request->workPhone==''){
			$user->admin_profile->work_phone = $request->workPhone;
		}

		if(!$request->about==''){
			$user->admin_profile->about = $request->about;
		}
		$user->admin_profile->full_name = $request->full_name;
		$user->save();
		$user->admin_profile->save();

		Session::flash('admin_update', 'Профиль обновлен успешно!');
		return redirect()->back();
    }
    
    /**
	 * Show accepted property
	 * */
	public function accepted_property() {		
		App::setLocale('ru');
		$properties = Property::where('accepted', 1)->where('expiring_at', '>', Carbon::now())->orderBy('created_at', 'desc')->paginate(20);		
		
		return view('admin.property.accepted')
			->with('properties', $properties)			
			->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
			->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray());
	}
	
	public function accepted_property_show($id) {
		App::setLocale('ru');
		$property = Property::find($id);
		$months_ru = $months_ru = ["янв", "фев", "мар", "апр", "май", "июн", "июл", "авг", "сент", "окт", "ноя", "дек"];

		return view('admin.property_show.single')
			->with('apartment_types', ApartmentType::all())
			->with('revamps', Revamp::all())
			->with('buildings', Building::all())
			->with('parkings', Parking::all())
			->with( 'velayats', Velayat::all())			
			->with('cities', City::all())
			->with('sale_types', SaleType::all())
			->with('room_layouts', RoomLayout::all())
			->with('bathrooms', Bathroom::all())
			->with('land_area_types', LandAreaType::all())
			->with('rent_terms', RentTerm::all())
			->with('heatings', Heating::all())
			->with('land_statuses', LandStatus::all())
			->with('bonus_agents', BonusAgent::all())
			->with('office_repairs', OfficeRepair::all())
			->with('office_conditions', OfficeCondition::all())
			->with('entrances', Entrance::all())
			->with('building_types', BuildingType::all())
			->with('ventilations', Ventilation::all())
            ->with('conditionings', Conditioning::all())            
			->with('firefightings', Firefighting::all())
			->with('land_owning_types', LandOwningType::all())
			->with('rent_types', RentType::all())
			->with('taxes', Tax::all())
			->with('building_entrances', BuildingEntrance::all())
			->with('trade_rooms', TradeRoom::all())
			->with('gates', Gates::all())
			->with('floor_materials', FloorMaterial::all())
			->with('parking_types', ParkingType::all())
			->with('land_owning_types', LandOwningType::all())
			->with('business_types_property', BusinessTypeProperty::all())
			->with('extra_possible_business_types', ExtraBusinessType::where('property_id', $id)->get())
			->with('months_ru', $months_ru)
			->with('property_full_type_id', ($property->saleOrRent + 1) . $property->object_names_id)
			->with('property', $property);
	}
	
	
    
    public function pending_properties() {
		Session::forget('active_tab_accepted');
		Session::forget('active_tab_expired');
		App::setLocale('ru');
		$properties = Property::where('accepted', 0)->orderBy('created_at', 'desc')->paginate(6);
		$velayats = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();

		return view('admin.property.pending')->with('properties',$properties)
			->with('types_ru', Type::all())
			->with('objects_ru', ObjectNames::all())
			->with( 'velayats', $velayats)			
			->with('cities', City::all());
    }
    
    /**
	 * Expired property
	 */

	public function expired_property(){
		Session::forget('active_tab_accepted');
		Session::forget('active_tab_pending');
		App::setLocale('ru');
		
		$velayats = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();
		$all_properties = Property::all();		
		$properties = [];

		foreach($all_properties as $property){
			if ($property->expired()){
				array_push($properties,$property);
			}
		}
		
		return view('admin.property.expired')
			->with('properties',$properties)
			->with('types_ru', Type::all())
			->with('objects_ru', ObjectNames::all())
			->with( 'velayats', $velayats)			
			->with('cities', City::all());
    }
    
    public function add_property(  ) {
		$types = Type::all('name_ru','id');
		$cities = City::all();
		$features = Feature::all();

		return view('admin.property.add')->with('types',$types)->with('cities',$cities)->with('features',$features);
    }
    
    public function submit_property( Request $request ) {
		$this->validate($request,[
			'title' => 'required',
			'area' => 'required|numeric',
			'price' => 'required|numeric',
			'rooms' => 'required|numeric|between:1,10',
			'description' => 'required',
			'img' => 'required',
			'lat' => 'required',
			'lng' => 'required'
		]);

		$featured = false;
		if (!(empty($featured))) {
			$featured = true;
		}

		$accepted = false;
		if ($request->accepted == 1) {
			$accepted = true;
		}

		$photoNames = [];
		$photoIds = [];

		$i = Image::count();
		$c = 0;
		foreach ($request->img as $img) {
			array_push($photoNames, time() . '.' . $img->getClientOriginalExtension());

			$img->move(public_path('img/property_grid'), $photoNames[$c]);

			Image::create([
				'id' => $i + 1,
				'name' => $photoNames[$c]
			]);
			$i++;
			$c++;
			array_push($photoIds, $i);
		}

		$city = City::find($request->city);

		$property = Property::create([
			'title'		 => $request->title,
			'rooms' 	 => $request->rooms,
			'type_id'	 => $request->type,
			'address' 	 => $request->address,
			'city_id' 	 => $request->city,
			'user_id' 	 => 1,
			'profile_id' => 2,
			'area' 		 => $request->area,
			'price' 	 => $request->price,
			'lat' 		 => $request->lat,
			'lng' 		 => $request->lng,
			'velayat_id' => $city->velayat->id,
			'accepted' 	 => $accepted,
			'featured' 	 => $featured,
			'saleOrRent' => $request->status,
			'expiring_at' =>  Carbon::now('Asia/Ashgabat')->addMonth(),
			'img' => 'img/property_grid/' . $photoNames[0]
		]);

		$property->feature()->attach($request->features);
		$property->image()->attach($photoIds);

		Session::flash('success','Ваше объявление добавлено');
		return redirect()->route('dashboard');
    }
    
    /**
	 * Site settings
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 *
	 */
	public function site_settings(){

		$settings_row = siteSetting::first();
		$ad_count = Advertisement::all()->count();


		$phone=preg_replace('/\s+/', '', $settings_row->contact_phone);
		$phone=substr($phone, 0, 4) .' (' . substr($phone, 4, 2) . ') '. substr($phone, 6, 2) . ' ' . substr($phone, 8, 2) . ' '. substr($phone, 10, 2);

		$phone1='';
		$phone2='';
		if($settings_row->contact_phone1!==''){
			$phone1=preg_replace('/\s+/', '', $settings_row->contact_phone1);
			$phone1=substr($phone1, 0, 4) .' (' . substr($phone1, 4, 2) . ') '. substr($phone1, 6, 2) . ' ' . substr($phone1, 8, 2) . ' '. substr($phone1, 10, 2);
		}

		if($settings_row->contact_phone2!==''){
			$phone2=preg_replace('/\s+/', '', $settings_row->contact_phone2);
			$phone2=substr($phone2, 0, 4) .' (' . substr($phone2, 4, 2) . ') '. substr($phone2, 6, 2) . ' ' . substr($phone2, 8, 2) . ' '. substr($phone2, 10, 2);
		}

		return view('admin.site_settings')->with('settings', $settings_row)->with('ad_cnt', $ad_count)->with('cities', City::all())->with('velayats', Velayat::all())->with('tel_1', $phone)->with('tel_2', $phone1)->with('tel_3', $phone2);
    }
    
    /**
	 * Approve property
	 */
	public function approve( $id ) {
		DB::table('properties')->where('id', $id)->update(['accepted' => 1]);

		return redirect()->back();
    }
    
    public function delete( $id ) {

		$property = Property::find($id);
        $property->delete();
        
		return redirect()->back();

    }
    
    public function ads(){

        $ads = Advertisement::all();
        
		return view('admin.ads')->with('ads',$ads);
    }
    
    public function ads_on( $id ){

		$ad = Advertisement::find($id);
		$ad->active = 1;
		$ad->save();

		return redirect()->back();
	}

	public function ads_off( $id ){
        
		$ad = Advertisement::find($id);
		$ad->active = 0;
		$ad->save();

		return redirect()->back();
	}

	public function delete_ad( $id ) {
		$ad = Advertisement::find($id);
		File::delete($ad->img);
		$ad->delete();

		return redirect()->back();
	}

	public function add( Request $request ) {

		$new_add = $request->img;
		$new_add_name = time().$new_add->getClientOriginalName();
		$new_add->move('img/', $new_add_name);

		Advertisement::create([
			'img' => 'img/' . $new_add_name,
		]);

		return redirect()->back();
    }
    
    /**
	 * All users
	 */
	public function users(){

        $users = User::where('admin',0)->get();
        
		return view('admin.users.users')->with('users',$users);
    }
    
    /**
	 * Validate site settings' inputs
	 * Update the settings
	 * Redirect back
	 */
	public function site_settings_update(Request $request){
		$this->validate($request, [
			'name' => 'required|max:255',
			'phone' => 'required',
			'email' => 'required|email|max:255',
			'address' => 'required|max:255|min:7',
			'about' => 'required|min:10',
			'latitude' => 'required',
			'longitude' => 'required',
			'api_key' => 'required',
			'map_tag' => 'required|max:100',
			'facebook' => 'required|max:255|url',
			'twitter' => 'required|max:255|url',
			'linkedin' => 'required|max:255|url',
			'instagram' => 'required|max:255|url',
		]);

		$settings_row = siteSetting::first();

		$settings_row->site_title = $request->name;
		$settings_row->contact_phone = $request->phone;
		$settings_row->contact_email = $request->email;
		$settings_row->contact_address = $request->address;
		$settings_row->about = $request->about;
		$settings_row->map_latitude = $request->latitude;
		$settings_row->map_longitude = $request->longitude;
		$settings_row->api_key = $request->api_key;
		$settings_row->map_tag = $request->map_tag;
		$settings_row->faceboook = $request->facebook;
		$settings_row->twitter = $request->twitter;
		$settings_row->linkedin = $request->linkedin;
		$settings_row->instagram = $request->instagram;

		if($request->hasFile('icon')){
			$this->validate($request, [ 'icon' => 'required|mimes:ico|max:5', ]);
			$temp = $settings_row->site_icon;
			$new_icon = $request->icon;
			$new_icon_name = time().$new_icon->getClientOriginalName();
			if($new_icon->move(public_path('/img'), $new_icon_name)){
				chmod(public_path($temp), 0777);
				unlink(public_path($temp));
			}
			$settings_row->site_icon = '/img/'.$new_icon_name;
		}

		if($request->hasFile('logo')){
			$this->validate($request, [ 'logo' => 'required|mimes:png,jpg,jpeg,bmp|max:10', ]);
			$temp1 = $settings_row->site_logo;
			$new_logo = $request->logo;
			$new_logo_name = time().$new_logo->getClientOriginalName();
			if($new_logo->move(public_path('/img'), $new_logo_name)){
				chmod(public_path($temp1), 0777);
				unlink(public_path($temp1));
			}
			$settings_row->site_logo = '/img/'.$new_logo_name;
		}

		if($request->hasFile('bottom_logo')){
			$this->validate($request, ['bottom_logo' => 'required|mimes:png,jpg,jpeg,bmp|max:10']);
			$temp4 = $settings_row->site_bottom_logo;
			$new_bottom_logo = $request->bottom_logo;
			$new_bottom_logo_name=time().$new_bottom_logo->getClientOriginalName();
			if($new_bottom_logo->move(public_path('/img'), $new_bottom_logo_name)){
				chmod(public_path($temp4), 0777);
				unlink(public_path($temp4));
			}
			$settings_row->site_bottom_logo = '/img/'.$new_bottom_logo_name;
		}

		if($request->hasFile('banner_img')){
			$this->validate($request, [ 'banner_img' => 'required|mimes:png,jpg,jpeg,bmp|max:500', ]);
			$temp2 = $settings_row->site_banner_img;
			$new_banner = $request->banner_img;
			$new_banner_name = time().$new_banner->getClientOriginalName();
			if($new_banner->move(public_path('/img/slider'), $new_banner_name)){
				chmod(public_path($temp2), 0777);
				unlink(public_path($temp2));
			}
			$settings_row->site_banner_img = '/img/slider/'.$new_banner_name;
		}

		if($request->hasFile('map_icon')){
			$this->validate($request, [ 'map_icon' => 'required', ]);
			$temp3 = $settings_row->map_icon;
			$new_map_icon = $request->map_icon;
			$new_map_icon_name = time().$new_map_icon->getClientOriginalName();
			if($new_map_icon->move(public_path('/img'), $new_map_icon_name)){
				chmod(public_path($temp3), 0777);
				unlink(public_path($temp3));
			}
			$settings_row->map_icon = '/img/'.$new_map_icon_name;
		}

		if(!$request->phone1==''){$settings_row->contact_phone1 = $request->phone1;}
		if(!$request->phone2==''){$settings_row->contact_phone2 = $request->phone2;}

		$settings_row->save();

		Session::flash('site_setting', 'Настройки сайта обновлены!');
		return redirect()->back();
    }
    
    public function city_edit($id){
		$city_row = City::find($id);
		return view('admin.edit_city')->with('city', $city_row)->with('velayats', Velayat::all());
    }
    
    /**
	 * Update city in site_settings page
	 * Return back to site_settings page
	 */
	public function city_update(Request $request, $id){
		$this->validate($request,[
			'city' => 'required|alpha|max:255',
			'velayat' => 'required',
		]);

		$city_row = City::where('id', $id)->first();
		$city_row->city = $request->city;
		$city_row->velayat_id = $request->velayat;
		$city_row->save();

		Session::flash('city_update', 'Город обновлен успешно!');
		return redirect()->route('site.settings');
    }
    
    /**
	 * Delete city in site_settings page
	 * Return back to site_settings page
	 */
	public function city_delete($id){
		$city_row = City::find($id);
		$city_row->delete();
		Session::flash('city_delete', 'Город удален успешно!');

		return redirect()->back();
    }
    
    /**
	 * Create user view
	 */
	public function create_user(  ) {
		return view('admin.users.add');
    }
    
    /**
	 * Submit new user
	 */
	public function submit_user( Request $request ) {
		
		$request->validate([
			'nickname' => 'required|min:3|unique:users,name',
			'first_name' => 'required|min:3',
			'surname' => 'required|min:3',
			'password' => 'required|alpha_num',
			'email' => 'required|email|unique:users,email',
			'about' => 'required',
			'tel1' => 'required',
			'avatar' => 'required',
			'type_user' => 'required'
		]);
		
		$agent = 0;
		if ($request->type_user === 1){
			$agent = 1;
		}

		$photo= time() . '.' . $request->avatar->getClientOriginalExtension();

		$request->avatar->move(public_path('img/teams'), $photo);

		$user = User::create([
			'name' => $request->nickname,
			'email' => $request->email,
			'agent' => $agent,
			'phone' => $request->tel1,
			'password' => bcrypt($request->password),
		]);

		$profile = Profile::create([
			'first_name' => $request->first_name,
			'last_name' => $request->surname,
			'avatar' => 'img/teams/' . $photo,
			'about' => $request->about,
			'add_phone' => $request->tel2,
			'user_id' => $user->id
		]);

		return redirect()->route('admin.users');
    }
    
    /**
	 * Delete(Ban) user
	 */
	public function delete_user( $id ) {
		$user = User::find($id);
		$user->delete();
		return redirect()->back();
    }
    
    /**
	 * Add new city for announcement use
	 * Redirect back
	 */
	public function city_add(Request $request){

		$this->validate($request, [
			'city' => 'required|max:255|unique:cities',
			'velayat' => 'required',
		]);

		City::create([
			'city' => $request->city,
			'velayat_id' => $request->velayat,
		]);

		Session::flash('new_city', 'Добавлен новый город!');
		return redirect()->back();
    }
    
    /**
	 * List of banned users
	 */
	public function deleted_users(){
		$users = User::withTrashed()->where('deleted_at', '!=', null)->get();

		return view('admin.users.deleted')->with('users',$users);
    }
    
    /**
	 * Restore user
	 */
	public function restore_user($id){
		User::withTrashed()->where('id',$id)->restore();

		return redirect()->back();
    }
    
    public function visitlog(){
		$visitlogs = DB::table('visitlogs')->orderBy('created_at','desc')->get();
		return view('admin.visitlog')->with('visitlogs', $visitlogs);
	}

	/**
	 * Filter the pending properties according to given parameters
	 */
	public function search_pending_property(Request $request){		
		App::setLocale('ru');
		
		if($request->type_deal_sel != 0){ 
			$type=['=',$request->type_deal_sel];
		} else {
			$type=['>',0];
		}

		if( $request->type_object != 0 ){ 
			$objects = [ '=', $request->type_object ];
		} else { $objects = [ '>', 0 ];
		}

		if( $request->velayat != 0 ){ 
			$velayats = [ '=',$request->velayat ];
		} else {
			$velayats = ['>', 0];
		}

		if( $request->etrap != 0 ){ 
			$etraps = ['=',$request->etrap];
		} else { $etraps = ['>', 0];
		}

		$velayats1 = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();

		$found = Property::where('accepted', 0)
				 ->where('saleOrRent', '=', $request->type_deal)
				 ->where('type_id', $type[0], $type[1])
				 ->where('object_names_id', $objects[0], $objects[1])
				 ->where('velayat_id', $velayats[0], $velayats[1])
				 ->where('city_id', $etraps[0], $etraps[1])
				 ->paginate(6);

		Session::flash('active_tab_pending', 'active');

		return view('admin.property.pending')
				->with('properties', $found)
				->with('types_ru', Type::all())
				->with('objects_ru', ObjectNames::all())
				->with('velayats', $velayats1)				
				->with('cities', City::all());
	}

	/**
	 * Filter the accepted properties according to given parameters
	 */
	public function search_accepted_property(Request $request){
		App::setLocale('ru');

		if( $request->type_deal_sel != 0 ){ 
			$type = ['=',$request->type_deal_sel];
		} else {
			$type = ['>',0];
		}

		if( $request->type_object != 0 ){ 
			$objects = ['=',$request->type_object];
		} else {
			$objects = ['>', 0]; 
		}

		if( $request->velayat != 0 ){ 
			$velayats = ['=',$request->velayat];
		} else {
			$velayats = ['>', 0];
		}

		if( $request->etrap != 0 ){ 
			$etraps = ['=',$request->etrap];
		} else {
			$etraps = ['>', 0];
		}

		$velayats1 = Velayat::where('id', '>', 0)
							->orderBy('id', 'desc')
							->get();

		$found = Property::where('accepted', 1)
			->where('saleOrRent', '=', $request->type_deal)
			->where('type_id', $type[0], $type[1])
			->where('object_names_id', $objects[0], $objects[1])
			->where('velayat_id', $velayats[0], $velayats[1])
			->where('city_id', $etraps[0], $etraps[1])->paginate(6);

		Session::flash('active_tab_accepted', 'done');

		return view('admin.property.accepted')
			->with('properties', $found)
			->with('types_ru', Type::all())
			->with('objects_ru', ObjectNames::all())
			->with('velayats', $velayats1)			
			->with('cities', City::all());
	}

	/**
	 * Filter the expired properties according to given parameters
	 */
	public function search_expired_property(Request $request){
		
		App::setLocale('ru');

		if( $request->type_deal_sel != 0 ){ 
			$type = ['=',$request->type_deal_sel];
		} else {
			$type = ['>',0];
		}

		if( $request->type_object != 0 ){ 
			$objects = ['=',$request->type_object];
		} else {
			$objects = ['>', 0];
		}

		if( $request->velayat != 0 ){ 
			$velayats = ['=',$request->velayat];
		} else {
			$velayats = ['>', 0];
		}		

		if( $request->etrap != 0 ){ 
			$etraps = ['=',$request->etrap];
		} else {
			$etraps = ['>', 0];
		}

		$velayats1 = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();

		$all_properties = Property::where('saleOrRent', '=', $request->type_deal)
			->where('type_id', $type[0], $type[1])
			->where('object_names_id', $objects[0], $objects[1])
			->where('velayat_id', $velayats[0], $velayats[1])
			->where('city_id', $etraps[0], $etraps[1])->get();
		$properties = [];
	
		foreach($all_properties as $property){
			if ($property->expired()){
				array_push($properties, $property);
			}
		}
		Session::flash('active_tab_expired', 'done');
		
		return view('admin.property.expired')
			->with('properties', $properties)
			->with('types_ru', Type::all())
			->with('objects_ru', ObjectNames::all())
			->with('velayats', $velayats1)			
			->with('cities', City::all());
	}
	
	/**
	 * Bring the accepted property into the suspended status
	 */
	public function property_return_pending($id){

		$property_row = Property::find($id);
		$property_row->accepted = 0;
		$property_row->save();

		$properties = Property::where('accepted', 1)->orderBy('created_at', 'desc')->paginate(6);
		$velayats = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();

		Session::flash('active_tab_accepted', 'done');
		return view('admin.property.accepted')
			->with('properties', $properties)
			->with('types_ru', Type::all())
			->with('objects_ru', ObjectNames::all())
			->with( 'velayats', $velayats)			
			->with('cities', City::all());

	}

	/**
	 * Bring the suspended property into the accepted status
	 */
	public function property_return_accepted($id){
		$property_row = Property::find($id);
		$property_row->accepted = 1;
		$property_row->save();
		
		$velayats = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();
		
		Session::flash('active_tab_pending', 'done');
		return view('admin.property.pending')
				->with('properties', Property::where('accepted', 0)->orderBy('created_at', 'desc')->paginate(6))
				->with('types_ru', Type::all())
				->with('objects_ru', ObjectNames::all())
				->with('velayats', $velayats)				
				->with('cities', City::all());
	} 

	
	/** List of complaints*/
    public function complaints()
    {
        return view('admin.complaints')->with('complaints', ListOfComplaints::all());
	}

    public function reply()
    {
        mail('hello@example.com','Subject','Reply','From: webmaster@example.com');

        return redirect()->back();
	}

    public function rules()
    {
        $documents = Documents::first();

        return view('admin.documents.rules')->with('rules', $documents->rules);
	}

    public function post_rules(Request $request)
    {
        $documents = Documents::first();
        $documents->rules = $request->editor;
        $documents->save();

        return redirect()->back();
	}

    public function license()
    {
        $documents = Documents::first();

        return view('admin.documents.license')->with('license', $documents->license);
    }

    public function post_license(Request $request)
    {
        $documents = Documents::first();
        $documents->license = $request->editor;
        $documents->save();

        return redirect()->back();
    }

    public function confidentiality()
    {
        $documents = Documents::first();

        return view('admin.documents.confidentiality')->with('confidentiality', $documents->confidentiality);
    }

    public function post_confidentiality(Request $request)
    {
        $documents = Documents::first();
        $documents->confidentiality = $request->editor;
        $documents->save();

        return redirect()->back();
    }

    public function api_keys()
    {
        $api_keys = ApiKeys::all();

        return view('admin.api_keys')->with('api_keys',$api_keys);
    }

    public function api_generate()
    {
        $key = str_random(20);

        ApiKeys::create([
           'key' => $key,
           'expirationDate' => Carbon::now()->addYear()
        ]);

        return redirect()->back();
    }

    public function description($id)
    {
        $property = Property::find($id);


        return view('admin.property.description')->with('property',$property);
    }


    public function upload()
    {
        return view('admin.upload');
    }

    public function upload_video(Request $request)
    {
        $file = $request->upload;
        $filename = $file->getClientOriginalName();
        $path = public_path() . '/video';
        $file->move($path, $filename);

        Video::create([
           'filename' => $filename
        ]);

        return redirect()->back();
    }

    public function video()
    {
        $video = Video::find(1);

        return view('admin.video')->with('video',$video);
    }


	public function delete_notification($id){
		AdminNotificationTable::find($id)->delete($id);
		return response()->json([ 
			'notif_deleted' => 'Уведомление успешно удалено.'
		]);
	}
}
