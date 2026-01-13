<?php

use Illuminate\Database\Seeder;
use App\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//Ашхабад
		City::create([
			'city_ru' => 'Багтыярлыкский этрап',
			'city_en' => 'Bagtyyarlyk district',
			'city_tm' => 'Bagtyýarlyk etraby',
		    'velayat_id' => 6
		]);
		
		City::create([
			'city_ru' => 'Беркарарлыкский этрап',
			'city_en' => 'Berkararlyk district',
			'city_tm' => 'Berkararlyk etraby',
		    'velayat_id' => 6
	    ]);
		
		City::create([
			'city_ru' => 'Безмеинский этрап',
			'city_en' => 'Buzmeyin district',
			'city_tm' => 'Büzmeýin etraby',
		    'velayat_id' => 6
		]);
		
		City::create([
			'city_ru' => 'Копетдагский этрап',
			'city_en' => 'Kopetdag district',
			'city_tm' => 'Köpetdag etraby',
		    'velayat_id' => 6
		]);

		//Aхал
		City::create([
			'city_ru' => 'Ак-Бугдайский этрап',
			'city_en' => 'Ak-bugday district',
			'city_tm' => 'Ak-Bugdaý etraby',
		    'velayat_id' => 1
		]);
		
		City::create([
			'city_ru' => 'Бабадайханский этрап',
			'city_en' => 'Babadayhan district',
			'city_tm' => 'Babadaýhan etraby',
		    'velayat_id' => 1
		]);

		City::create([
		    'city_ru' => 'Бахарлынский этрап',
			'city_en' => 'Baharly district',
			'city_tm' => 'Baharly etraby',
		    'velayat_id' => 1
	    ]);

		City::create([
			'city_ru' => 'Гёкдепинский этрап',
			'city_en' => 'Gokdepe district',
			'city_tm' => 'Gökdepe etraby',
		    'velayat_id' => 1
		]);
		
		City::create([
			'city_ru' => 'Какинский этрап',
			'city_en' => 'Kaka district',
			'city_tm' => 'Kaka etraby',
		    'velayat_id' => 1
		]);
		
		City::create([
			'city_ru' => 'Сарахский этрап',
			'city_en' => 'Serakhs district',
			'city_tm' => 'Sarahs etraby',
		    'velayat_id' => 1
		]);
		
		App\City::create([
			'city_ru' => 'Тедженский этрап',
			'city_en' => 'Tejen district',
			'city_tm' => 'Tejen etraby',
		    'velayat_id' => 1
		]);
		
		//Балканский
		App\City::create([
			'city_ru' => 'г. Балканабад',
			'city_en' => 'Balkanabat city',
			'city_tm' => 'Balkanabat ş.',
		    'velayat_id' => 5
		]);

		App\City::create([
			'city_ru' => 'г. Гумдаг',
			'city_en' => 'Gumdag city',
			'city_tm' => 'Gumdag ş.',
		    'velayat_id' => 5
		]);
		
		App\City::create([
			'city_ru' => 'г. Туркменбаши',
			'city_en' => 'Turkmenbashy city',
			'city_tm' => 'Türkmenbaşy ş.',
		    'velayat_id' => 5
		]);
		
		App\City::create([
			'city_ru' => 'г. Хазар',
			'city_en' => 'Hazar city',
			'city_tm' => 'Hazar ş.',
		    'velayat_id' => 5
		]);

		App\City::create([
			'city_ru' => 'г. Сердар',
			'city_en' => 'Serdar city',
			'city_tm' => 'Serdar ş.',
		    'velayat_id' => 5
		]);
		
		City::create([
			'city_ru' => 'Берекетский этрап',
			'city_en' => 'Bereket district',
			'city_tm' => 'Bereket etraby',
		    'velayat_id' => 5
		]);
		
		City::create([
			'city_ru' => 'Эсенкулийский этрап',
			'city_en' => 'Esenguly district',
			'city_tm' => 'Esenguly etraby',
		    'velayat_id' => 5
		]);
		
		City::create([
			'city_ru' => 'Этрекский этрап',
			'city_en' => 'Etrek district',
			'city_tm' => 'Etrek etraby',
		    'velayat_id' => 5
		]);
		
		City::create([
			'city_ru' => 'Махтумкулийский этрап',
			'city_en' => 'Magtymguly district',
			'city_tm' => 'Magtymguly etraby',
		    'velayat_id' => 5
		]);
		
		City::create([
			'city_ru' => 'Сердарский этрап',
			'city_en' => 'Serdar district',
			'city_tm' => 'Serdar etraby',
		    'velayat_id' => 5
		]);
		
		City::create([
			'city_ru' => 'Туркменбашийский этрап',
			'city_en' => 'Turkmenbashy district',
			'city_tm' => 'Türkmenbaşy etraby',
		    'velayat_id' => 5
		]);

		City::create([
			'city_ru' => 'Аваза этрап',
			'city_en' => 'Awaza district',
			'city_tm' => 'Awaza etraby',
		    'velayat_id' => 5
		]);

		//Дашогузский
		City::create([
			'city_ru' => 'Акдепинский этрап',
			'city_en' => 'Akdepe district',
			'city_tm' => 'Akdepe etraby',
		    'velayat_id' => 4
		]);
		
		City::create([
			'city_ru' => 'Болдумсазский этрап',
			'city_en' => 'Boldumsaz district',
			'city_tm' => 'Boldumsaz etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'Гёроглынский этрап',
			'city_en' => 'Gorogly district',
			'city_tm' => 'Görogly etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'Губадагский этрап',
			'city_en' => 'Gubadag district',
			'city_tm' => 'Gubadag etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'Кёнеургенчский этрап',
			'city_en' => 'Koneurgench district',
			'city_tm' => 'Köneurgenç etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'Рухубелентский этрап',
			'city_en' => 'Ruhubelent district',
			'city_tm' => 'Ruhubelent etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'этрап имени Гурбансолтан-эдже',
			'city_en' => 'Gurbansoltan eje district',
			'city_tm' => 'Gurbansoltan eje etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'этрап имени С. А. Ниязова',
			'city_en' => 'Saparmurat Niyazov district',
			'city_tm' => 'Saparmyrat Nyýazow etraby',
		    'velayat_id' => 4
	    ]);

	    City::create([
			'city_ru' => 'этрап имени Сапармурата Туркменбаши',
			'city_en' => 'Saparmurat Turkmenbashi district',
			'city_tm' => 'Saparmyrat Türkmenbaşy etraby',
		    'velayat_id' => 4
	    ]);

		//Лебапский
		App\City::create([
			'city_ru' => 'г. Туркменабад',
			'city_en' => 'Turkmenabat city',
			'city_tm' => 'Türkmenabat ş.',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Дарганатынский этрап',
			'city_en' => 'Darganata district',
			'city_tm' => 'Darganata etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Довлетлийский этрап',
			'city_en' => 'Dovletli district',
			'city_tm' => 'Döwletli etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Дяневский этрап',
			'city_en' => 'Danew district',
			'city_tm' => 'Dänew etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Керкинский этрап',
			'city_en' => 'Kerki district',
			'city_tm' => 'Kerki etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Кёйтендагский этрап',
			'city_en' => 'Koytendag district',
			'city_tm' => 'Köýtendag etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Саятский этрап',
			'city_en' => 'Sayat district',
			'city_tm' => 'Saýat etraby',
		    'velayat_id' => 3
		]);
		
		City::create([
			'city_ru' => 'Фарапский этрап',
			'city_en' => 'Farap district',
			'city_tm' => 'Farap etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Халачский этрап',
			'city_en' => 'Halach district',
			'city_tm' => 'Halaç etraby',
		    'velayat_id' => 3
	    ]);

		City::create([
			'city_ru' => 'Ходжамбазский этрап',
			'city_en' => 'Hojambaz district',
			'city_tm' => 'Hojambaz etraby',
		    'velayat_id' => 3
		]);

		City::create([
			'city_ru' => 'Чарджевский этрап',
			'city_en' => 'Charjew district',
			'city_tm' => 'Çärjew etraby',
		    'velayat_id' => 3
		]);

		//Мары
		App\City::create([
			'city_ru' => 'г. Мары',
			'city_en' => 'Mary city',
			'city_tm' => 'Mary ş.',
		    'velayat_id' => 2
		]);

		App\City::create([
			'city_ru' => 'г. Байрамали',
			'city_en' => 'Bayramaly city',
			'city_tm' => 'Baýramaly ş.',
		    'velayat_id' => 2
		]);
		
		App\City::create([
			'city_ru' => 'г. Мургап',
			'city_en' => 'Murgap city',
			'city_tm' => 'Murgap ş.',
		    'velayat_id' => 2
		]);

		App\City::create([
			'city_ru' => 'г. Сакарчага',
			'city_en' => 'Sakarchage city',
			'city_tm' => 'Sakarçäge ş.',
		    'velayat_id' => 2
		]);

		App\City::create([
			'city_ru' => 'г. Шатлык',
			'city_en' => 'Shatlyk city',
			'city_tm' => 'Şatlyk ş.',
		    'velayat_id' => 2
		]);

		App\City::create([
			'city_ru' => 'г. Серхетабад',
			'city_en' => 'Serhetabat city',
			'city_tm' => 'Serhetabat ş.',
		    'velayat_id' => 2
		]);

		App\City::create([
			'city_ru' => 'г. уркменгала',
			'city_en' => 'Turkmengala city',
			'city_tm' => 'Türkmengala ş.',
		    'velayat_id' => 2
		]);

		App\City::create([
			'city_ru' => 'г. Ёлётен',
			'city_en' => 'Ýoloten city',
			'city_tm' => 'Ýolöten ş.',
		    'velayat_id' => 2
		]);

		City::create([
			'city_ru' => 'Байрамалинский этрап',
			'city_en' => 'Bayramaly district',
			'city_tm' => 'Baýramaly etraby',
		    'velayat_id' => 2
		]);
		
		City::create([
			'city_ru' => 'Каракумский этрап',
			'city_en' => 'Garagum district',
			'city_tm' => 'Garagum etraby',
		    'velayat_id' => 2
		]);
		
		City::create([
			'city_ru' => 'Марыйский этрап',
			'city_en' => 'Mary district',
			'city_tm' => 'Mary etraby',
		    'velayat_id' => 2
		]);

		City::create([
			'city_ru' => 'Мургапский этрап',
			'city_en' => 'Murgap district',
			'city_tm' => 'Murgap etraby',
		    'velayat_id' => 2
		]);
		
		City::create([
			'city_ru' => 'Огузханский этрап',
			'city_en' => 'Oguzhan district',
			'city_tm' => 'Oguzhan etraby',
		    'velayat_id' => 2
		]);
		
		City::create([
			'city_ru' => 'Сакарчагинский этрап',
			'city_en' => 'Sakarchage district',
			'city_tm' => 'Sakarçäge etraby',
		    'velayat_id' => 2
		]);

		City::create([
			'city_ru' => 'Серхетабадский этрап',
			'city_en' => 'Serhetabat district',
			'city_tm' => 'Serhetabat etraby',
		    'velayat_id' => 2
		]);

		City::create([
			'city_ru' => 'Тагтабазарский этрап',
			'city_en' => 'Tagtabazar district',
			'city_tm' => 'Tagtabazar etraby',
		    'velayat_id' => 2
		]);
		
		City::create([
			'city_ru' => 'Туркменкалинский этрап',
			'city_en' => 'Turkmengala district',
			'city_tm' => 'Türkmengala etraby',
		    'velayat_id' => 2
		]);

	    City::create([
			'city_ru' => 'Векилбазарский этрап',
			'city_en' => 'Wekilbazar district',
			'city_tm' => 'Wekilbazar etraby',
		    'velayat_id' => 2
		]);

	    City::create([
			'city_ru' => 'Ёлётенский этрап',
			'city_en' => 'Yoloten district',
			'city_tm' => 'Ýolöten etraby',
		    'velayat_id' => 2
	    ]);

    }
}
