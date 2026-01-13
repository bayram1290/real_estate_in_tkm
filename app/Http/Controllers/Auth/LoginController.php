<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\NotYetUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
//
//    protected $redirectTo = '/profile/my-properties';

	public function redirectToProvider()
	{
		return Socialite::driver('google')->redirect();
	}

	public function handleProviderCallback()
	{
		$user = Socialite::driver('google')->user();

		//$userModel = new User;
		//$createdUser = $userModel->addNew($user);

		$user_f = User::where('email', $user->email)->first();

		if (!$user_f){
		    $nyu = NotYetUser::create([
                'name' => $user->user['name']['givenName'],
                'last_name' => $user->user['name']['familyName'],
                'email' => $user->email,
            ]);

            Session::flash('nu',$nyu->id);
            return redirect('/register');
		}
		else{
			Auth::loginUsingId($user_f->id);
		}
		//Auth::loginUsingId($createdUser->id);
		return redirect()->route('index');
		// $user->token;
	}

    protected function authenticated( Request $request, $user ) {

        $favorite = Cookie::get( 'favorite' );
        if ( ! empty( $favorite ) ) {
            $arr = explode(',', $favorite);
            $user->favorite_properties()->sync($arr);
        }

        if (isset($user->admin)){
            if ($user->admin){
                return redirect()->intended('/');
            }
            else{
                return redirect()->intended('/profile/my-properties');
            }
        }
        else{
	        return redirect()->intended('/profile/my-properties');
        }
    }

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	    if ( Session::has( 'lang' ) ) {
		    App::setLocale( session( 'lang' ) );
	    } else {
		    App::setLocale( 'ru' );
	    }

        $this->middleware('guest')->except('logout');
    }
}
