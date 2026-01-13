<?php

namespace App\Http\Controllers;

use Jrean\UserVerification\Facades\UserVerification;
use Auth;

use App\Advertisement;
use App\Documents;
use App\Mail\ContactMail;
use App\Newsletter;
use App\ObjectNames;
use App\Profile;
use Illuminate\Support\Facades\App;
use App\Property;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\adminProfile;
use App\User;
use App\siteSetting;
use App\City;
use App\Velayat;
use App\Feature;
use App\Image;
use Carbon\Carbon;
use VisitLog;
use Torann\GeoIP\Facades\GeoIP;
use App\propertyDealType;
use App\propertyObjectType;

use Illuminate\Support\Facades\Mail;
use MailChimp_Newsletter;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Home page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (Session::has('lang')){
			App::setLocale(session('lang'));
			$lang = session('lang');
		}
		else{
			App::setLocale('ru');
			$lang = 'ru';
		}

		$recents = Property::where('accepted',1)->orderBy('created_at','desc')->take(6)->get();
		$types = Type::all();
		$objects = ObjectNames::all();
		$ads = Advertisement::where('active',1)->get();

		$velayats = Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get();
		$cities = City::all();
		$ip = VisitLog::save();

		return view('index')
			->with( 'types_' . $lang , $types )
			->with( 'objects', $objects )
			->with( 'properties', $recents )
			->with( 'ads', $ads )
			->with( 'velayats', $velayats)
			->with( 'cities', $cities)
			->with('ip', $ip)
			->with('p_deals_ru', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_deals_en', propertyDealType::pluck('type_en')->toArray())
            ->with('p_deals_tm', propertyDealType::pluck('type_ru')->toArray())
            ->with('p_objects_ru', propertyObjectType::pluck('name_ru')->toArray())
            ->with('p_objects_en', propertyObjectType::pluck('name_en')->toArray())
            ->with('p_objects_tm', propertyObjectType::pluck('name_tm')->toArray());
	}
	/**
	 * Pricing Table
	 */

	public function pricing(  ) {
		if (Session::has('lang')){
			App::setLocale(session('lang'));
		}
		else{
			App::setLocale('ru');
		}

		return view('site.pricing');
	}

	/**
	 * Contact page
	 */

	public function contact(  ) {
		if (Session::has('lang')){
			App::setLocale(session('lang'));
		}
		else{
			App::setLocale('ru');
		}

		return view('site.contact');
	}

    public function verify()
    {
        return view('google0c76e51b8c4c624f');
	}

    public function verify_email()
    {
        if (Session::has('lang')){
            App::setLocale(session('lang'));
        }
        else{
            App::setLocale('ru');
        }

        return view('verify');
	}

    public function send_verification_email()
    {
        $user = Auth::user();

        UserVerification::generate($user);
        UserVerification::send($user, __('messages.subject_verify'), 'hello@example.com', $name = 'example.com');

        Session::flash('email_sent',"Письмо для подтверждения аккаунта было отправлено на вашу почту");
        return redirect()->back();
    }

	public function ship(Request $request){
		
		$request->validate([
			'g-recaptcha-response' => 'required|captcha',			
			'email' => 'required|email',
			'firstname' => 'required|alpha',
			'lastname' => 'required|alpha',
			'subject' => 'required',
			'message' => 'required',
		]);

		Mail::to('hello@example.com')->send(new ContactMail($request));

		Session::flash('success_ship', 'Mail sent successfully');
		return redirect()->back();
	}

	public function rules(){
		if (Session::has('lang')){
			App::setLocale(session('lang'));
		}
		else{
			App::setLocale('ru');
		}

		$documents = Documents::first();

		return view('terms_rights.rules')->with('documents',$documents);
	}

    public function license(){
        if (Session::has('lang')){
            App::setLocale(session('lang'));
        }
        else{
            App::setLocale('ru');
        }

        $documents = Documents::first();

        return view('terms_rights.license')->with('documents',$documents);
    }

    public function confidentiality(){
        if (Session::has('lang')){
            App::setLocale(session('lang'));
        }
        else{
            App::setLocale('ru');
        }

        $documents = Documents::first();

        return view('terms_rights.confidentiality')->with('documents', $documents);
    }

    public function subscribe(Request $request){

		$request->validate([
			'subscribe_email' => 'required|email',			
		]);

		if( ! Newsletter::where('email', $request->subscribe_email)->first() ){
			Newsletter::create([ 'email' => $request->subscribe_email ]);
		}
		
		if( ! MailChimp_Newsletter::isSubscribed($request->subscribe_email) ){
			MailChimp_Newsletter::subscribe($request->subscribe_email);
			Session::flash('subscribe_success', 'Вы успешно подписались на новостную рассылку');
		}
		
        return redirect()->back();
    }
	
}
