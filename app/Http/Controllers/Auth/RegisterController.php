<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use App\Property;
use Illuminate\Contracts\Auth\Authenticatable;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Courier\Courier;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Session::has('lang')) {
            App::setLocale(session('lang'));
        } else {
            App::setLocale('ru');
        }

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|unique:users',
//            'add_phone' => 'unique:profiles',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//    	if ($data['role'] == 'agent'){
//    		$role = 1;
//	    }
//	    else{
//    		$role = 0;
//	    }

        if (Session::has('lang')){
            App::setLocale(session('lang'));
        }
        else{
            App::setLocale('ru');
        }

        if (!isset($data['avatar'])) {
            $photoName = 'images/dashboard/users/1.jpg';
        } else {
            $photoName = 'img/teams/' . time() . '.' . $data['avatar']->getClientOriginalExtension();;
            $data['avatar']->move(public_path('img/teams/'), $photoName);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
        ]);

        $courier = new Courier();

        $courier->setRecipient($data['phone'])->setBody('Hello World')->send();

        UserVerification::generate($user);
        UserVerification::send($user, __('messages.subject_verify'), 'hello@example.com', $name = 'example.com');

	    $favorites = Cookie::get('favorite');
	    if (!empty($favorites) && isset($favorites)) {
            $arr = explode(',', $favorites);
            for ($i = 0; $i < count($arr); $i++) {
                $property = Property::find($arr[$i]);
                if (isset($property)) {
                    if (!$property->favorite_user->contains($user->id)) {
                        $property->favorite_user()->attach($user->id);
                    }
                }
            }
        }

	    Profile::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'avatar' => $photoName,
            'add_phone' => $data['add_phone'],
            'about' => 'description',
            'user_id' => $user->id
        ]);


        return $user;
    }
}
