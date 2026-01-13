<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\accountType;
use App\City;

class ProfileController extends Controller
{
	public function profile(  ) {

		if ( Session::has( 'lang' ) ) {
			App::setLocale( session( 'lang' ) );
		} else {
			App::setLocale( 'ru' );
		}

		$user = Auth::user();
		$profile = Profile::where('user_id',$user->id)->first();

		return view('user.profile')->with('profile',$profile)->with('user',$user)->with('accounts', accountType::all());
	}

	public function submit( $id, Request $request ) {

		$profile = Profile::where('user_id',$id)->first();
		$user = User::find($id);

		$user->name = $request->name;
		$user->email = $request->email;
		$user->phone = $request->phone;
		$profile->first_name = $request->first_name;
		$profile->last_name = $request->last_name;
		$profile->about = $request->about;
		$profile->add_phone = $request->add_phone;


		$user->save();
		$profile->save();

		return redirect()->back();
	}

	public function edit_image( Request $request ) {
		$profile = Profile::where('user_id',Auth::id())->first();

		$photoName = time().'.'.$request->user_image->getClientOriginalExtension();
		$request->user_image->move(public_path('img/teams/'), $photoName);
		$profile->avatar = 'img/teams/'.$photoName;

		$profile->save();

		return redirect()->back();
	}

	public function favorite(  ) {
		if ( Session::has( 'lang' ) ) {
			App::setLocale( session( 'lang' ) );
		} else {
			App::setLocale( 'ru' );
		}

		$properties = Auth::user()->favorite_properties;
		return view('profile.favorite')->with('properties', $properties)->with('cities', City::all());
	}

	

}
