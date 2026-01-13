<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siteSetting extends Model
{
	// public $table = 'site_settings';
	protected $fillable = [
		'site_title', 'site_icon', 'site_logo', 'site_bottom_logo', 'site_banner_img', 'contact_phone', 'contact_phone1', 'contact_phone2', 'contact_email', 'contact_address', 'about_ru', 'about_en', 'about_tm',  'map_latitude', 'map_longitude', 'api_key', 'map_icon', 'map_tag', 'faceboook', 'twitter', 'linkedin', 'instagram'
	];
}
