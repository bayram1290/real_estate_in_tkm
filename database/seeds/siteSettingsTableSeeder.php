<?php

use Illuminate\Database\Seeder;
use App\siteSetting;

class siteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    siteSetting::create([
		    'site_title' => 'Real Estate',
		    'site_icon' => '/img/favicon.ico',
		    'site_logo' => '/img/top_logo.png',
		    'site_bottom_logo' => '/img/bottom_logo.png',
		    'site_banner_img' => '/img/slider/fixed-slider.png',
		    'contact_phone' => '+993 12 34 56 78',
		    'contact_phone1' => '+993 12 34 56 78',
		    'contact_phone2' => '+993 12 34 56 78',
		    'contact_email' => 'hello@example.com',
		    'contact_address' => 'John Doe 1234 Elm St Springfield, IL 62704',
			'about_ru' => 'На сайте вы найдёте объекты по аренде и продаже недвижимости в Туркменистане. Все квартиры, дома и другие объекты проверены нашей командой модераторов. Вы можете, а также просто находить предложения благодаря хорошо структурированному каталогу и форме поиска на нашем сайте.',
			'about_en' => 'In the site, you will find all renting and selling properties in Turkmenistan. All apartments, houses and other properties registered in the site are checked by our moderator team. Also, you can find suggestions through a well-structured catalog and search form in our website.',
			'about_tm' => '',
		    'map_latitude' => '15.23456',
		    'map_longitude' => '15.23456',
		    'api_key' => 'my api key',
		    'map_icon' => '/img/marker_blue.png',
		    'map_tag' => 'My real estate tag',
		    'faceboook' => 'facebook.com',
		    'twitter' => 'https://twitter.com/realestate',
		    'linkedin' => 'http://www.linkedin.com/in/realesate',
		    'instagram' => 'https://www.instagram.com/realestate/',
	    ]);
    }
}
