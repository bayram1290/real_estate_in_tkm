<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_settings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('site_title')->default('Real Estate');
			$table->string('site_icon');
			$table->string('site_logo');
			$table->string('site_bottom_logo');
			$table->string('site_banner_img');
			$table->string('contact_phone');
			$table->string('contact_phone1')->nullable();
			$table->string('contact_phone2')->nullable();
			$table->string('contact_email');
			$table->string('contact_address');
			$table->text('about_ru');
			$table->text('about_en');
			$table->text('about_tm');
			$table->string('map_latitude');
			$table->string('map_longitude');
			$table->string('api_key');
			$table->string('map_icon');
			$table->string('map_tag');
			$table->string('faceboook');
			$table->string('twitter');
			$table->string('linkedin');
			$table->string('instagram');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('site_settings');
	}
}
