<?php

namespace App\Http\Controllers;

use App\Property;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Advertisement;
use App\ObjectNames;
use App\Type;
use App\Feature;
use App\BuildingType;
use App\Velayat;
use App\City;
use App\Revamp;
use App\Parking;
use App\ParkingType;
use App\OfficeCondition;
use App\Infrastructure;
use App\RentType;
use App\BusinessTypeProperty;
use App\LandOwningType;

class FavoriteController extends Controller
{
	/**  Make the property as favorite,
	 *   if authorized user, save it in database and cookies
	 *   else guest user, save only in coookies, 
	 *   return json format  
	 *  @return mixed
	 */ 
	public function make( $idded ){
		
		if( $idded = 'null' ){
			$id = request()->id;
		}else{
			$id = $idded;	
		}
		
		if( Auth::id() ){
			$property = Property::find($id);

			if( !$property->favorite_user->contains(Auth::id()) ){
				
				$property->favorite_user()->attach(Auth::id());
				
				//Cookie
				$date = Carbon::now()->addYears(2)->diffInMinutes();
				$favorites = Cookie::get('favorite');

				if( !empty($favorites) ){
					
					$arr = explode(',', $favorites);

					if (!in_array($id,$arr)){
						
						$favorites .= ',' .$id;
						Cookie::queue('favorite', $favorites,$date);
					}

				}else {
					$favorites = strval($id);
					Cookie::queue('favorite', $favorites,$date);
				}
			}

			Session::flash('count', Auth::user()->favorite_properties->count());

			$count = [ 'count' => Auth::user()->favorite_properties->count() ];

			if( $idded = 'null' ){
				return response()->json($count);	
			} else {
				return redirect()->back();				
			}

		}else {
			
			$date = Carbon::now()->addYears(2)->diffInMinutes();

			$favorites = Cookie::get('favorite');

			if( !empty($favorites) ){
				
				$arr = explode(',',$favorites);

				if( !in_array($id,$arr) ){
					
					$favorites .= ',' .$id;
					Session::flash('count', count($arr) + 1);
					$count = [ 'count' => count($arr) + 1 ];
					Cookie::queue('favorite',$favorites,$date);

				}else {
					
					Session::flash('count',count($arr));
					$count = [ 'count' => count($arr) ];
					
				}
			}else {

				$favorites = strval($id);
				Session::flash('count',1);
				$count = [ 'count' => 1 ];
				Cookie::queue('favorite',$favorites,$date);

			}
			
			if( $idded = 'null' ){
				return response()->json($count);
			} else {
				return redirect()->back();				
			}
			
		}
    }

	/** Show guest list favorite saved only in cookies 
	 *  @return mixed
	 */
	
	public function guest() {
		if ( Session::has( 'lang' ) ) {
			App::setLocale( session( 'lang' ) );
			$lang = session( 'lang' );
		} else {
			App::setLocale( 'ru' );
			$lang = 'ru';
		}

		$favorites = Cookie::get('favorite');
		$arr = explode(',', $favorites);

		$properties = Property::whereIn( 'id', $arr )->orderBy('created_at', 'desc')->paginate(6);

		return view('site.favorite')
			->with('properties', $properties)
			->with('velayats', Velayat::where('id', '>', 0)->orderBy('id', 'desc')->get())
			->with('cities', City::all())
			->with('features', Feature::all())
			->with('revamps', Revamp::all())
			->with('types_' . $lang, Type::all())
			->with('parkings', Parking::all())
			->with('objects', ObjectNames::all())
			->with('ads', Advertisement::where('active', 1)->get())
			->with('conditions', OfficeCondition::all())
			->with('build_appoints', BuildingType::all())
			->with('infras', Infrastructure::all())
			->with('r_types', RentType::all())
			->with('buss_t_props', BusinessTypeProperty::all())
            ->with('st_props', LandOwningType::all());
    }

	/** Decrease selected favorite property by one from the favorite list
	 *  return json format  
	 *  @return mixed
	 */
	public function decrease() {
		$id = request()->id;
		if (Auth::id()){
			$property =Property::find($id);

			if ($property->favorite_user->contains(Auth::id())){
				$property->favorite_user()->detach(Auth::id());
				//Cookie
				$date = Carbon::now()->addYears(2)->diffInMinutes();
				$favorites = Cookie::get('favorite');
				$arr = explode(',',$favorites);
				if (($key = array_search($id, $arr)) !== false){
					unset($arr[$key]);
					$favorites = implode(',',$arr);
					Cookie::queue('favorite',$favorites,$date);
				}
				if (empty($arr)){
					Cookie::queue(Cookie::forget('favorite'));
				}
				else{
					Cookie::queue('favorite',$favorites,$date);
				}
			}
			Session::flash('count',Auth::user()->favorite_properties->count());
			$count = [
				'count' => Auth::user()->favorite_properties->count()
			];
			return response()->json($count);
		}
		else{
			$date = Carbon::now()->addYears(2)->diffInMinutes();

			$favorites = Cookie::get('favorite');
			$arr = explode(',',$favorites);
			if (($key = array_search($id, $arr)) !== false){
				unset($arr[$key]);
				$favorites = implode(',',$arr);
				Session::flash('count',count($arr));
				$count = [
					'count' => count($arr)
				];
				Cookie::queue('favorite',$favorites,$date);
			}
			if (empty($arr)){
				Cookie::queue(Cookie::forget('favorite'));
			}
			else{
				Session::flash('count',count($arr));
				$count = [
					'count' => count($arr)
				];
				Cookie::queue('favorite',$favorites,$date);
			}

			return response()->json($count);
		}
    }

    public function make_sync($id){
		
		if( Auth::id() ){
			$property=Property::find($id);

            if( !$property->favorite_user->contains(Auth::id()) ){
				
				$property->favorite_user()->attach(Auth::id());

                //Cookie
                $date = Carbon::now()->addYears(2)->diffInMinutes();
				$favorites = Cookie::get('favorite');
				
                if( !empty($favorites) ){

					$arr = explode(',',$favorites);
					
                    if( !in_array($id,$arr) ){
                        $favorites .= ',' .$id;
                        Cookie::queue('favorite',$favorites,$date);
					}
					
                }else {
                    $favorites = strval($id);
                    Cookie::queue('favorite',$favorites,$date);
                }
			}
			
			Session::flash('count',Auth::user()->favorite_properties->count());
			
			$count = [ 'count' => Auth::user()->favorite_properties->count() ];
			
            return redirect()->back();
        }else {
			
			$date = Carbon::now()->addYears(2)->diffInMinutes();

			$favorites = Cookie::get('favorite');
			
            if( !empty($favorites) ){

				$arr = explode(',',$favorites);
				
                if( !in_array($id,$arr) ){
					
					$favorites .= ',' . $id;
                    Session::flash('count',count($arr) + 1);
                    $count = [ 'count' => count($arr) + 1 ];
                    Cookie::queue('favorite',$favorites,$date);
                }else{
                    Session::flash('count',count($arr));
                    $count = [
                        'count' => count($arr)
                    ];
                }
            }
            else{
                $favorites = strval($id);
                Session::flash('count',1);
                $count = [
                    'count' => 1
                ];
                Cookie::queue('favorite',$favorites,$date);
            }

            return redirect()->back();
        }

    }
}
