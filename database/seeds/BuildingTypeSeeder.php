<?php

use Illuminate\Database\Seeder;
use App\BuildingType;

class BuildingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BuildingType::create([
            'type_ru' => 'Административное здание',
            'type_en' => 'Administrative building',
            'type_tm' => 'Dolandyryş binasy'
        ]);

        BuildingType::create([
            'type_ru' => 'Бизнес-центр',
            'type_en' => 'Business center',
            'type_tm' => 'Işewürlik merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Деловой центр',
            'type_en' => 'Corp-business center',
            'type_tm' => 'Iş merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Деловой квартал',
            'type_en' => 'Corp-business quarter',
            'type_tm' => 'Işewürlik kwartaly'
        ]);

        BuildingType::create([
            'type_ru' => 'Деловой дом',
            'type_en' => 'Corp-business house',
            'type_tm' => 'Işewürlik öýi'
        ]);

        BuildingType::create([
            'type_ru' => 'Бизнес-парк',
            'type_en' => 'Business-Park',
            'type_tm' => 'Işewürlik-park'
        ]);

        BuildingType::create([
            'type_ru' => 'Бизнес-квартал',
            'type_en' => 'Business-quarter',
            'type_tm' => 'Işewürlik-kwartal'
        ]);

        BuildingType::create([
            'type_ru' => 'Объект свободного назначения',
            'type_en' => 'Flexible purposes',
            'type_tm' => 'Dürli maksatar üçin'
        ]);

        BuildingType::create([
            'type_ru' => 'Производственный комплекс',
            'type_en' => 'Manufacturing complex',
            'type_tm' => 'Önümçilik toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Индустриальный парк',
            'type_en' => 'Industrial park',
            'type_tm' => 'Industrial seýil bagy'
        ]);

        BuildingType::create([
            'type_ru' => 'Промплощадка',
            'type_en' => 'Industrial site',
            'type_tm' => 'Senagat meýdançasy'
        ]);

        BuildingType::create([
            'type_ru' => 'Производственно-складской комплекс',
            'type_en' => 'Industrial-warehouse complex',
            'type_tm' => 'Senagat ammary toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Логистический центр',
            'type_en' => 'Logistics center',
            'type_tm' => 'Logistika merkez'
        ]);

        BuildingType::create([
            'type_ru' => 'Логистический комплекс',
            'type_en' => 'Logistics complex',
            'type_tm' => 'Logistika toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Особняк',
            'type_en' => 'Mansion',
            'type_tm' => 'Mülk ýeri'
        ]);

        BuildingType::create([
            'type_ru' => 'Производственное здание',
            'type_en' => 'Manufacture building',
            'type_tm' => 'Önümçilik binasy'
        ]);

        BuildingType::create([
            'type_ru' => 'Производственный цех',
            'type_en' => 'Manufacturing facility',
            'type_tm' => 'Önümçilik sehi'
        ]);

        BuildingType::create([
            'type_ru' => 'Модульное здание',
            'type_en' => 'Modular building',
            'type_tm' => 'Modul binasy'
        ]);

        BuildingType::create([
            'type_ru' => 'Многофункциональный комплекс',
            'type_en' => 'Multifunctional complex',
            'type_tm' => 'Köp maksatly toplum'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисный центр',
            'type_en' => 'Office center',
            'type_tm' => 'Ofis merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисный комплекс',
            'type_en' => 'Office complex',
            'type_tm' => 'Ofis toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисный квартал',
            'type_en' => 'Office quarter',
            'type_tm' => 'Ofis kwartaly'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисно-гостиничный комплекс',
            'type_en' => 'Office hotel complex',
            'type_tm' => 'Ofis-myhmanhan toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисно-жилой комплекс',
            'type_en' => 'Office residential complex',
            'type_tm' => 'Ofis-ýaşaýyş toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисно-складское',
            'type_en' => 'Office warehouse',
            'type_tm' => 'Ofis ammary'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисно-складской комплекс',
            'type_en' => 'Office-warehouse complex',
            'type_tm' => 'Ofis ammar toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисное здание',
            'type_en' => 'Office building',
            'type_tm' => 'Ofis binasy'
        ]);

        BuildingType::create([
            'type_ru' => 'Офисно-производственный комплекс',
            'type_en' => 'Office production complex',
            'type_tm' => 'Ofis önümçilik toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Старый фонд',
            'type_en' => 'Old Fund',
            'type_tm' => 'Köne gazna'
        ]);

        BuildingType::create([
            'type_ru' => 'Другое',
            'type_en' => 'Other',
            'type_tm' => 'Beýleki'
        ]);

        BuildingType::create([
            'type_ru' => 'Аутлет',
            'type_en' => 'Outlet',
            'type_tm' => 'Autlet'
        ]);

        BuildingType::create([
            'type_ru' => 'Имущественный комплекс',
            'type_en' => 'Property complex',
            'type_tm' => 'Emläk toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Жилой комплекс',
            'type_en' => 'Residential complex',
            'type_tm' => 'Ýaşaýyş toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Жилой дом',
            'type_en' => 'House',
            'type_tm' => 'Ýaşaýyş jaýy'
        ]);

        BuildingType::create([
            'type_ru' => 'Торгово-деловой комплекс',
            'type_en' => 'Trade-business complex',
            'type_tm' => 'Söwda-iş toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Торгово-общественный центр',
            'type_en' => 'Trade-social center',
            'type_tm' => 'Söwda-jemgiýetçilik merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Торгово-развлекательный центр',
            'type_en' => 'Shopping-entertainment center',
            'type_tm' => 'Söwda-dynç alyş merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Торговый центр',
            'type_en' => 'Shopping center',
            'type_tm' => 'Söwda merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Торговый комплекс',
            'type_en' => 'Shopping complex',
            'type_tm' => 'Söwda toplumy'
        ]);

        BuildingType::create([
            'type_ru' => 'Торговый дом',
            'type_en' => 'Trading house',
            'type_tm' => 'Söwda öýi'
        ]);

        BuildingType::create([
            'type_ru' => 'Специализированный торговый центр',
            'type_en' => 'Specialized shopping center',
            'type_tm' => 'Ýöriteleşdirilen söwda merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Отдельно стоящее здание',
            'type_en' => 'Stand-alone building',
            'type_tm' => 'Aýry duran bina'
        ]);

        BuildingType::create([
            'type_ru' => 'Технопарк',
            'type_en' => 'Technopark',
            'type_tm' => 'Tehnologiýa merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Торгово-выставочный комплекс',
            'type_en' => 'Trade-exhibition complex',
            'type_tm' => 'Söwda sergi merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Торгово-офисный комплекс',
            'type_en' => 'Trade-office complex',
            'type_tm' => 'Söwda ofis merkezi'
        ]);

        BuildingType::create([
            'type_ru' => 'Склад',
            'type_en' => 'Warehouse',
            'type_tm' => 'Ammar'
        ]);

        BuildingType::create([
            'type_ru' => 'Складской комплекс',
            'type_en' => 'Warehouse complex',
            'type_tm' => 'Ammar toplumy'
        ]);
    }
}
