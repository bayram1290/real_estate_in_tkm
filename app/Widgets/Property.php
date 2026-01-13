<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Property extends AbstractWidget
{
	/**
	 * The configuration array.
	 *
	 * @var array
	 */
	protected $config = [];

	/**
	 * Treat this method as a controller action.
	 * Return view() or other content to display.
	 */
	public function run()
	{
		$count = \App\Property::count();
		$string = 'Properties';

		return view('voyager::dimmer', array_merge($this->config, [
			'icon'   => 'voyager-news',
			'title'  => "{$count} {$string}",
			'text'   => __('voyager.dimmer.post_text', ['count' => $count, 'string' => Str::lower($string)]),
			'button' => [
				'text' => 'View all properties',
				'link' => route('voyager.properties.index'),
			],
			'image' => '/images/daniel-von-appen-329871-unsplash.jpg',
		]));
	}
}
