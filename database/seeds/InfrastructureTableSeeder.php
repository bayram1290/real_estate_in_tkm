<?php

use Illuminate\Database\Seeder;
use App\Infrastructure;

class InfrastructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Infrastructure::create([
            'infrastructure_ru' => 'отделение банка',
            'infrastructure_en' => 'branch of a bank',
            'infrastructure_tm' => 'bank şahamçasy',
            'img' => '/images/icons/bank3.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'парк',
            'infrastructure_en' => 'park',
            'infrastructure_tm' => 'park',
            'img' => '/images/icons/park2.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'салон красоты',
            'infrastructure_en' => 'beauty saloon',
            'infrastructure_tm' => 'gözellik salony',
            'img' => '/images/icons/beauty_salon.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'автосервис',
            'infrastructure_en' => 'car service',
            'infrastructure_tm' => 'awtoserwis',
            'img' => '/images/icons/car_service.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'автомойка',
            'infrastructure_en' => 'car wash',
            'infrastructure_tm' => 'awto ýuwalga',
            'img' => '/images/icons/car_wash.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'конференц-зал',
            'infrastructure_en' => 'convention hall',
            'infrastructure_tm' => 'konferensiýa zaly',
            'img' => '/images/icons/conf_room.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'офисные помещения',
            'infrastructure_en' => 'office premises',
            'infrastructure_tm' => 'ofis jaýy',
            'img' => '/images/icons/office_room.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'банкомат',
            'infrastructure_en' => 'cash dispenser',
            'infrastructure_tm' => 'bankomat',
            'img' => '/images/icons/atm.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'складские помещения',
            'infrastructure_en' => 'depository',
            'infrastructure_tm' => 'sklad ýeri',
            'img' => '/images/icons/warehouse.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'кафе',
            'infrastructure_en' => 'cafe',
            'infrastructure_tm' => 'kafe',
            'img' => '/images/icons/caffee.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'фитнесс-центр',
            'infrastructure_en' => 'fitness center',
            'infrastructure_tm' => 'fitnes merkezi',
            'img' => '/images/icons/fitness.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'столовая',
            'infrastructure_en' => 'dining room',
            'infrastructure_tm' => 'naharhana',
            'img' => '/images/icons/food.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'ресторан',
            'infrastructure_en' => 'restaurant',
            'infrastructure_tm' => 'restoran',
            'img' => '/images/icons/restaurant.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'гостиница',
            'infrastructure_en' => 'hotel',
            'infrastructure_tm' => 'otel',
            'img' => '/images/icons/hotel3.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'медицинский центр',
            'infrastructure_en' => 'medical center',
            'infrastructure_tm' => 'medisina merkezi',
            'img' => '/images/icons/medcenter3.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'минимаркет',
            'infrastructure_en' => 'minimarket',
            'infrastructure_tm' => 'minimarket',
            'img' => '/images/icons/minimarket.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'аптека',
            'infrastructure_en' => 'pharmacy',
            'infrastructure_tm' => 'dermanhana',
            'img' => '/images/icons/pharmacy.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'бассейн',
            'infrastructure_en' => 'pool',
            'infrastructure_tm' => 'basseýn',
            'img' => '/images/icons/pool.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'кинотеатр',
            'infrastructure_en' => 'cinema',
            'infrastructure_tm' => 'kinoteatr',
            'img' => '/images/icons/movie.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'фотосалон',
            'infrastructure_en' => 'photo studio',
            'infrastructure_tm' => 'foto salon',
            'img' => '/images/icons/photosalon.png'
        ]);

        Infrastructure::create([
            'infrastructure_ru' => 'супермаркет',
            'infrastructure_en' => 'supermarket',
            'infrastructure_tm' => 'supermarket',
            'img' => '/images/icons/supermarket.png'
        ]);

    }
}
