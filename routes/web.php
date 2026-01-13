<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
/**
 * Home route
 */

Route::get( '/', [
	'uses' => 'HomeController@index',
	'as'   => 'index'
] );

Route::get( '/google0c76e51b8c4c624f.html', [
    'uses' => 'HomeController@verify',
    'as'   => 'verify'
] );

Route::get('/rules',[
	'uses' => 'HomeController@rules',
	'as' => 'rules'
]);

Route::get('/email/verify',[
   'uses' => 'HomeController@verify_email',
   'as' => 'verify.email'
]);

Route::get('/email/send/verification',[
    'uses' => 'HomeController@send_verification_email',
    'as' => 'verify.send.email'
])->middleware('auth');

Route::get('/license',[
    'uses' => 'HomeController@license',
    'as' => 'license'
]);

Route::get('/confidentiality',[
    'uses' => 'HomeController@confidentiality',
    'as' => 'confidentiality'
]);

Route::get('login/google', [
	'uses' => 'Auth\LoginController@redirectToProvider',
	'as' => 'register.google'
]);
Route::get('login/google/callback', [
	'uses' => 'Auth\LoginController@handleProviderCallback',
	'as' => 'register.google.callback'
]);

/**
 * Pricing route
 */

Route::get( '/contact', [
	'uses' => 'HomeController@contact',
	'as'   => 'contact'
] );

Route::post('/contact/send',[
	'uses' => 'HomeController@ship',
	'as' => 'mail.send'
]);

Route::get('/select/{id}',[
	'uses' => 'HomeController@select',
	'as' => 'select'
]);

/**
 * Change language
 */

Route::get('/cngloc/{lang}', function ($lang){
	session(['lang'=>$lang]);

	return redirect()->back();
});

Route::post('/make-favorite/{id?}', [
	'uses' => 'FavoriteController@make',
	'as' => 'make.favorite'
]);

Route::post('/decrease-favorite/{id?}',[
	'uses' => 'FavoriteController@decrease',
	'as' => 'decrease.favorite'
]);

Route::get('favorite/guest',[
	'uses' => 'FavoriteController@guest',
	'as' => 'favorite.guest'
]);

/**
 * List of properties
 */

Route::get( '/properties-list', [
	'uses' => 'PropertyController@getProperties',
	'as' => 'list'
] );


 /**
  * Go to the living property page
  */
Route::get('/single-property/living/{id}',[
	'uses' => 'PropertyController@single_living',
	'as' => 'single.living'
]);

/**
  * Go to the commercial property page
  */
Route::get('/single-property/commercial/{id}',[
    'uses' => 'PropertyController@single_commercial',
    'as' => 'single.commercial'
]);

/**
  * Send email to the property owner from single living/commercial page
  */
Route::post('/single-property/{id}', 'PropertyController@send_email_to_owner')->name('single.mail.owner');

/**
 * Show published properties by a user in single_living or single_commercial page
 */
Route::get('/single-property/{user_id}', 'PropertyController@single_user_properties')->name('single.user.properties');


/**
 * Properties by velayat
 */

Route::get('/property/velayat/{id}',[
	'uses' => 'PropertyController@velayat_property',
	'as' => 'property.velayat'
]);

Route::get('/property/type/{id}',[
	'uses' => 'PropertyController@type_property',
	'as' => 'property.type'
]);

/**
 * Ajax request for filtering property
 */

Route::post('/filter',[
	'uses' => 'PropertyController@filterType',
	'as' => 'filter'
]);

/**
 * Searching property by price, area, city, etc.
 */
Route::get('/search', [
	'uses' => 'PropertyController@searchProperty',
	'as' => 'property.search'
]);

Route::get('/search/main',[
	'uses' => 'PropertyController@searchPropertyMain',
	'as' => 'property.search.main'
]);

Route::post('/newsletter/subscribe',[
   'uses' => 'HomeController@subscribe',
   'as' => 'newsletter.subscribe'
]);

Route::group(['prefix' => 'api'],function (){
    Route::get('/properties/{apiKey}',[
        'uses' => 'ApiController@api_properties',
        'as' => 'api.properties'
    ]);

    Route::get('/data/{apiKey}',[
        'uses' => 'ApiController@api_users',
        'as' => 'api.users'
    ]);

    Route::get('/objects/{apiKey}',[
        'uses' => 'ApiController@api_objects',
        'as' => 'api.objects'
    ]);

    Route::get('/cities/{apiKey}',[
        'uses' => 'ApiController@api_cities',
        'as' => 'api.cities'
    ]);

    Route::get('/velayats/{apiKey}',[
        'uses' => 'ApiController@api_velayats',
        'as' => 'api.velayats'
    ]);

    Route::get('/ads/{apiKey}',[
        'uses' => 'ApiController@api_ads',
        'as' => 'api.ads'
    ]);

    Route::get('/ads/{apiKey}',[
        'uses' => 'ApiController@api_bathrooms',
        'as' => 'api.bathrooms'
    ]);

    Route::get('/buildings/{apiKey}',[
        'uses' => 'ApiController@api_buildings',
        'as' => 'api.buildings'
    ]);

    Route::get('/building_types/{apiKey}',[
        'uses' => 'ApiController@api_building_types',
        'as' => 'api.building_types'
    ]);

    Route::get('/business_types/{apiKey}',[
        'uses' => 'ApiController@api_business_types',
        'as' => 'api.business_types'
    ]);

    Route::get('/features/{apiKey}',[
        'uses' => 'ApiController@api_features',
        'as' => 'api.features'
    ]);

    Route::get('/rent_terms/{apiKey}',[
        'uses' => 'ApiController@api_rent_terms',
        'as' => 'api.rent_terms'
    ]);

    Route::get('/rent_types/{apiKey}',[
        'uses' => 'ApiController@api_rent_types',
        'as' => 'api.rent_types'
    ]);

    Route::get('/profiles/{apiKey}',[
        'uses' => 'ApiController@api_profiles',
        'as' => 'api.profiles'
    ]);

    Route::get('/periods/{apiKey}',[
        'uses' => 'ApiController@api_periods',
        'as' => 'api.periods'
    ]);

    Route::get('/ventilations/{apiKey}',[
        'uses' => 'ApiController@api_ventilations',
        'as' => 'api.ventilations'
    ]);

    Route::get('/taxes/{apiKey}',[
        'uses' => 'ApiController@api_taxes',
        'as' => 'api.taxes'
    ]);

    Route::get('/revamps/{apiKey}',[
        'uses' => 'ApiController@api_revamps',
        'as' => 'api.revamps'
    ]);

    Route::get('/infrastructures/{apiKey}',[
        'uses' => 'ApiController@api_infrastructures',
        'as' => 'api.infrastructures'
    ]);

    Route::get('/conditioning/{apiKey}',[
        'uses' => 'ApiController@api_conditioning',
        'as' => 'api.conditioning'
    ]);

    Route::get('/entrances/{apiKey}',[
        'uses' => 'ApiController@api_entrances',
        'as' => 'api.entrances'
    ]);

    Route::get('/floor_materials/{apiKey}',[
        'uses' => 'ApiController@api_floor_materials',
        'as' => 'api.floor_materials'
    ]);

    Route::get('/types/{apiKey}',[
        'uses' => 'ApiController@api_types',
        'as' => 'api.types'
    ]);

    Route::get('/possible_appointments/{apiKey}',[
        'uses' => 'ApiController@api_possible_appointments',
        'as' => 'api.possible_appointments'
    ]);

    Route::get('/office_conditions/{apiKey}',[
        'uses' => 'ApiController@api_office_conditions',
        'as' => 'api.office_conditions'
    ]);

    Route::get('/office_repairs/{apiKey}',[
        'uses' => 'ApiController@api_office_repairs',
        'as' => 'api.office_repairs'
    ]);

    Route::get('/gates/{apiKey}',[
        'uses' => 'ApiController@api_gates',
        'as' => 'api.gates'
    ]);

    Route::get('/heating/{apiKey}',[
        'uses' => 'ApiController@api_heating',
        'as' => 'api.heating'
    ]);

    Route::get('/firefighting/{apiKey}',[
        'uses' => 'ApiController@api_firefighting',
        'as' => 'api.firefighting'
    ]);

    Route::get('/newsletters/{apiKey}',[
        'uses' => 'ApiController@api_newsletters',
        'as' => 'api.newsletters'
    ]);

    Route::get('/add_service/{apiKey}',[
        'uses' => 'ApiController@api_add_services',
        'as' => 'api.add_service'
    ]);

    Route::get('/bonus_agents/{apiKey}',[
        'uses' => 'ApiController@api_bonus_agents',
        'as' => 'api.bonus_agents'
    ]);

    Route::get('/building_entrances/{apiKey}',[
        'uses' => 'ApiController@api_building_entrances',
        'as' => 'api.bonus_agents'
    ]);

    Route::get('/business_types_property/{apiKey}',[
        'uses' => 'ApiController@api_business_types_property',
        'as' => 'api.business_types_property'
    ]);

    Route::get('/day_week/{apiKey}',[
        'uses' => 'ApiController@api_day_week',
        'as' => 'api.day_week'
    ]);

    Route::get('/parkings/{apiKey}',[
        'uses' => 'ApiController@api_parkings',
        'as' => 'api.parkings'
    ]);

    Route::get('/trade_rooms/{apiKey}',[
        'uses' => 'ApiController@api_trade_rooms',
        'as' => 'api.trade_rooms'
    ]);

    Route::get('/property_descriptions/{apiKey}',[
        'uses' => 'ApiController@api_property_descriptions',
        'as' => 'api.property_descriptions'
    ]);

    Route::get('/revamps/{apiKey}',[
        'uses' => 'ApiController@api_revamps',
        'as' => 'api.revampsI'
    ]);

});

/**
 * Report the property for misuse
 */
Route::get('/property/report/{id}', 'PropertyController@report_prop')->name('report.property');
Route::post('/property/complain/{id}','PropertyController@complain')->name('report.complain');


Route::group(['middleware' => ['auth', 'user_verified']],function (){
    
	/**
	 * Posting property to database by a user
	 */
	Route::group(['prefix' => 'submit-property'], function (){
        
        /**
         * Page of adding property by user(submitting property)
         */

        Route::get('/submit', [
            'uses' => 'PropertyController@submit1',
            'as' => 'property.submit.page'
        ]);

        Route::post('/load/image',[
           'uses' => "PropertyController@loadImg",
           'as' => 'load.image'
        ]);

        Route::post('/delete/image',[
            'uses' => "PropertyController@deleteImg",
            'as' => 'delete.image'
        ]);

        Route::post('/submit-prop',[
            'uses' => 'CreatePropertyControllerTest@create',
            'as' => 'property.submit'
        ]);
    });

    Route::get('/profile',[
		'uses' => 'ProfileController@profile',
		'as' => 'profile.user'
	]);

	Route::post('/profile/submit/{id}',[
		'uses' => 'ProfileController@submit',
		'as' => 'profile.edit.submit'
	]);

	Route::post('/profile/image',[
		'uses' => 'ProfileController@edit_image',
		'as' => 'profile.image.edit'
	]);

	Route::get('/profile/cng-pswd',[
		'uses' => 'UserController@change_pswd',
		'as' => 'user.change_pswd'
	]);

	Route::post('/profile/assword/reset','UserController@changePassword')->name('changePassword');

	Route::get('/profile/my-properties','UserController@my_properties')->name('my_properties');

	/**
	 * Editing property
	 */

	Route::get('/edit/{id}',[
		'uses' => 'UserController@edit_page',
		'as' => 'property.edit.page'
	])->middleware('user_property');

	

     /**
	 * Post edit of property
	 */
	Route::post('property/resubmit/{id}',[
		'uses' => 'PropertyController@resubmit',
		'as' => 'property.resubmit'
	])->middleware('user_property');

	
    /**
	 * Submit change on the property
	 */
	Route::post('/submit-edit/{id}',[
		'uses' => 'UserController@edit_property',
		'as' => 'property.edit'
	]);

    /**
	 * Delete selected the user property
	 */
	Route::get('/property/delete/{id}',[
		'uses' => 'PropertyController@delete',
		'as' => 'property.delete'
    ]);
    
    // Route::post('/property/renew/{id}', 'PropertyController@renew_property')->name('property.renew');

	Route::get('/favorite-properties','ProfileController@favorite')->name('favorite.properties');

	/**
	 * Make main image for the property
	 */
	Route::get('/property/image/main/{id}/{n_name}', 'PropertyController@main_Img')->name('property.mImage');

	/**
	 * Delete image of the property
	 */
    Route::get('/property/image/delete/{id}/{del_img}', 'PropertyController@image_delete')->name('property.image.delete');
    
    /** Bring the expired property back to active state for month 
     * Hence, save notifcation into database for admin */
    Route::post('/property/return/expired/{id}/{type}', 'PropertyController@property_return_expired')->name('property.return.expired');   
    	
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){

	/**  Dashboard route  */
	Route::get('/dashboard', 'adminPanelController@dashboard')->name('dashboard');

	/**  Admin profile route  */
	Route::get('/profile', 'adminPanelController@admin_profile')->name('profile');

	/**  Admin profile update and redirect back */
	Route::post('/profile/update', 'adminPanelController@admin_profile_update')->name('admin.profile.update');

	/** Accepted property list route */
    Route::get('/property/accepted', 'adminPanelController@accepted_property')->name('accepted.property');
    
    /** Accepted property list route */
    Route::get('/property/accepted/show/{id}', 'adminPanelController@accepted_property_show')->name('accepted.property.show');

	/** Accepted property list route */
	Route::get('/property/pending', 'adminPanelController@pending_properties')->name('pending.property');

	/** Accepted property list route */
	Route::get('/property/expired', 'adminPanelController@expired_property')->name('expired.property');

	/** Site settings route */
	Route::get('/site/settings', 'adminPanelController@site_settings')->name('site.settings');

	/** Approve property */
	Route::get('/approve/{id}', 'adminPanelController@approve')->name('approve.property');

	/** Property not approved - delete */
	Route::get('/property/delete/{id}', 'adminPanelController@delete')->name('delete.property');

	/** Advertisement settings*/
	Route::get('/advertisement','adminPanelController@ads')->name('advertisement');

	/** Advertisement turn on*/
	Route::get('/advertisement/on/{id}','adminPanelController@ads_on')->name('advertisement.on');

	/** Advertisement turn off*/
	Route::get('/advertisement/off/{id}','adminPanelController@ads_off')->name('advertisement.off');

	/** Advertisement turn off*/
	Route::get('/advertisement/delete/{id}','adminPanelController@delete_ad')->name('advertisement.delete');

	/** Advertisement add */
	Route::post('/advertisement/add',"adminPanelController@add")->name('advertisement.add');

	/** Show all users */
	Route::get('/users/all','adminPanelController@users')->name('admin.users');

	/** Edit site settings */
	Route::post('/site/settings/edit', 'adminPanelController@site_settings_update')->name('site.settings.edit');

	/** Direct to the city update (for announcement) in site settings*/
	Route::get('/site/settings/city/edit/{id}', 'adminPanelController@city_edit')->name('site.settings.city.edit');

	/** Update city for announcement
	 *  Redirect back to site settings
	 */
	Route::post('/site/settings/city/update/{id}', 'adminPanelController@city_update')->name('site.settings.city.update');

	/** Delete city for announcement in site settings*/
	Route::get('/site/settings/city/delete/{id}', 'adminPanelController@city_delete')->name('site.settings.city.delete');

	/** User create view */
	Route::get('/user/create','adminPanelController@create_user')->name('admin.user.create');

	/** User create view */
	Route::post('/user/create/submit','adminPanelController@submit_user')->name('admin.user.submit');

	/** Delete(ban) user */
	Route::get('/user/{id}','adminPanelController@delete_user')->name('admin.user.delete');

	/** Add new city for announcement
	 *  Redirect back to site settings
	 */
	Route::post('/site/settings/city/add', 'adminPanelController@city_add')->name('site.settings.city.add');

	/** Show deleted(banned) users */
	Route::get('/users/deleted', 'adminPanelController@deleted_users')->name('admin.users.deleted');

	/** Show deleted(banned) users */
	Route::get('/user/restore/{id}', 'adminPanelController@restore_user')->name('admin.user.restore');

	Route::get('/visitlog','adminPanelController@visitlog')->name('visitlog');

	/** Search for pending property */
	Route::post('/search/pending/property', 'adminPanelController@search_pending_property')->name('pending.property.search');

	/** Search for accepted property */
	Route::post('/search/accepted/property', 'adminPanelController@search_accepted_property')->name('accepted.property.search');

	/** Search for expired property */
	Route::post('/search/expired/property', 'adminPanelController@search_expired_property')->name('expired.property.search');

	/** Bring the accepted property back to suspending status */
	Route::get('/property/return/pending/{id}', 'adminPanelController@property_return_pending')->name('property.return.pending');

	/** Bring the suspended property back to accepted status */
	Route::get('/property/return/accepted/{id}', 'adminPanelController@property_return_accepted')->name('property.return.accepted');

	/** List of complaints */
	Route::get('/complaints','adminPanelController@complaints')->name('complaints');


	Route::get('/reply/complaints','adminPanelController@reply')->name('reply.complaint');

	Route::get('documents/rules',[
        'uses' => 'adminPanelController@rules',
        'as' => 'admin.rules'
    ]);

    Route::post('documents/rules/post',[
        'uses' => 'adminPanelController@post_rules',
        'as' => 'admin.rules.post'
    ]);

    Route::get('documents/license',[
        'uses' => 'adminPanelController@license',
        'as' => 'admin.license'
    ]);

    Route::post('documents/license/post',[
        'uses' => 'adminPanelController@post_license',
        'as' => 'admin.license.post'
    ]);

    Route::get('documents/confidentiality',[
        'uses' => 'adminPanelController@confidentiality',
        'as' => 'admin.confidentiality'
    ]);

    Route::post('documents/confidentiality/post',[
        'uses' => 'adminPanelController@post_confidentiality',
        'as' => 'admin.confidentiality.post'
    ]);

    Route::get('/api/keys',[
       'uses' => 'adminPanelController@api_keys',
       'as' => 'api.keys'
    ]);

    Route::get('/api/generate',[
        'uses' => 'adminPanelController@api_generate',
        'as' => 'api.generate'
    ]);

    Route::get('/description/{id}','adminPanelController@description')->name('property.admin.description');
    Route::get('/upload','adminPanelController@upload')->name('property.admin.upload');
    Route::post('/upload/post','adminPanelController@upload_video')->name('property.admin.upload.post');
    Route::get('/video','adminPanelController@video')->name('video');

    Route::delete('/notification/delete/{id}', 'adminPanelController@delete_notification')->name('notification.delete');

});
