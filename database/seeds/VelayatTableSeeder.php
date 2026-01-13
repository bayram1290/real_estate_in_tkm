<?php

use Illuminate\Database\Seeder;
use App\Velayat;

class VelayatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Velayat::create([            
		    'velayat_ru' => 'Ахалский',
			'velayat_en' => 'Ahal',
			'velayat_tm' => 'Ahal',
		    'img' => 'ahal.jpg'
	    ]);

	    Velayat::create([            
		    'velayat_ru' => 'Марыйский',
			'velayat_en' => 'Mary',
			'velayat_tm' => 'Mary',
		    'img' => 'mary.jpg'
	    ]);

	    Velayat::create([            
		    'velayat_ru' => 'Лебапский',
			'velayat_en' => 'Lebap',
			'velayat_tm' => 'Lebap',
		    'img' => 'lebap.jpg'
	    ]);

	    Velayat::create([            
		    'velayat_ru' => 'Дашогузский',
			'velayat_en' => 'Dashoguz',
			'velayat_tm' => 'Daşoguz',
		    'img' => 'dashoguz.jpg'
	    ]);

	    Velayat::create([            
		    'velayat_ru' => 'Балканский',
			'velayat_en' => 'Balkan',
			'velayat_tm' => 'Balkan',
		    'img' => 'balkan.jpg'
	    ]);

	    Velayat::create([
		    'velayat_ru' => 'Ашхабад',
			'velayat_en' => 'Ashgabat',
            'velayat_tm' => 'Aşgabat',
		    'img' => 'ashgabat.jpg'
	    ]);
    }
}
