<?php

use Illuminate\Database\Seeder;
use App\PossibleAppointment;

class PossibleAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PossibleAppointment::create([
            'appointment_ru' => 'Административное здание',
            'appointment_en' => 'Administrative building',
            'appointment_tm' => 'Dolandyryş binasy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Бизнес-центр',
            'appointment_en' => 'Business center',
            'appointment_tm' => 'Işewürlik merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Деловой центр',
            'appointment_en' => 'Corp-business center',
            'appointment_tm' => 'Iş merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Деловой квартал',
            'appointment_en' => 'Corp-business quarter',
            'appointment_tm' => 'Işewürlik kwartaly'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Деловой дом',
            'appointment_en' => 'Corp-business house',
            'appointment_tm' => 'Işewürlik öýi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Бизнес-парк',
            'appointment_en' => 'Business-Park',
            'appointment_tm' => 'Işewürlik-park'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Бизнес-квартал',
            'appointment_en' => 'Business-quarter',
            'appointment_tm' => 'Işewürlik-kwartal'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Объект свободного назначения',
            'appointment_en' => 'Flexible purposes',
            'appointment_tm' => 'Dürli maksatar üçin'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Производственный комплекс',
            'appointment_en' => 'Manufacturing complex',
            'appointment_tm' => 'Önümçilik toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Индустриальный парк',
            'appointment_en' => 'Industrial park',
            'appointment_tm' => 'Industrial seýil bagy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Промплощадка',
            'appointment_en' => 'Industrial site',
            'appointment_tm' => 'Senagat meýdançasy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Производственно-складской комплекс',
            'appointment_en' => 'Industrial-warehouse complex',
            'appointment_tm' => 'Senagat ammary toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Логистический центр',
            'appointment_en' => 'Logistics center',
            'appointment_tm' => 'Logistika merkez'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Логистический комплекс',
            'appointment_en' => 'Logistics complex',
            'appointment_tm' => 'Logistika toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Особняк',
            'appointment_en' => 'Mansion',
            'appointment_tm' => 'Mülk ýeri'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Производственное здание',
            'appointment_en' => 'Manufacture building',
            'appointment_tm' => 'Önümçilik binasy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Производственный цех',
            'appointment_en' => 'Manufacturing facility',
            'appointment_tm' => 'Önümçilik sehi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Модульное здание',
            'appointment_en' => 'Modular building',
            'appointment_tm' => 'Modul binasy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Многофункциональный комплекс',
            'appointment_en' => 'Multifunctional complex',
            'appointment_tm' => 'Köp maksatly toplum'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисный центр',
            'appointment_en' => 'Office center',
            'appointment_tm' => 'Ofis merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисный комплекс',
            'appointment_en' => 'Office complex',
            'appointment_tm' => 'Ofis toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисный квартал',
            'appointment_en' => 'Office quarter',
            'appointment_tm' => 'Ofis kwartaly'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисно-гостиничный комплекс',
            'appointment_en' => 'Office hotel complex',
            'appointment_tm' => 'Ofis-myhmanhan toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисно-жилой комплекс',
            'appointment_en' => 'Office residential complex',
            'appointment_tm' => 'Ofis-ýaşaýyş toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисно-складское',
            'appointment_en' => 'Office warehouse',
            'appointment_tm' => 'Ofis ammary'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисно-складской комплекс',
            'appointment_en' => 'Office-warehouse complex',
            'appointment_tm' => 'Ofis ammar toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисное здание',
            'appointment_en' => 'Office building',
            'appointment_tm' => 'Ofis binasy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Офисно-производственный комплекс',
            'appointment_en' => 'Office production complex',
            'appointment_tm' => 'Ofis önümçilik toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Старый фонд',
            'appointment_en' => 'Old Fund',
            'appointment_tm' => 'Köne gazna'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Другое',
            'appointment_en' => 'Other',
            'appointment_tm' => 'Beýleki'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Аутлет',
            'appointment_en' => 'Outlet',
            'appointment_tm' => 'Autlet'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Имущественный комплекс',
            'appointment_en' => 'Property complex',
            'appointment_tm' => 'Emläk toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Жилой комплекс',
            'appointment_en' => 'Residential complex',
            'appointment_tm' => 'Ýaşaýyş toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Жилой дом',
            'appointment_en' => 'House',
            'appointment_tm' => 'Ýaşaýyş jaýy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торгово-деловой комплекс',
            'appointment_en' => 'Trade-business complex',
            'appointment_tm' => 'Söwda-iş toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торгово-общественный центр',
            'appointment_en' => 'Trade-social center',
            'appointment_tm' => 'Söwda-jemgiýetçilik merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торгово-развлекательный центр',
            'appointment_en' => 'Shopping-entertainment center',
            'appointment_tm' => 'Söwda-dynç alyş merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торговый центр',
            'appointment_en' => 'Shopping center',
            'appointment_tm' => 'Söwda merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торговый комплекс',
            'appointment_en' => 'Shopping complex',
            'appointment_tm' => 'Söwda toplumy'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торговый дом',
            'appointment_en' => 'Trading house',
            'appointment_tm' => 'Söwda öýi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Специализированный торговый центр',
            'appointment_en' => 'Specialized shopping center',
            'appointment_tm' => 'Ýöriteleşdirilen söwda merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Отдельно стоящее здание',
            'appointment_en' => 'Stand-alone building',
            'appointment_tm' => 'Aýry duran bina'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Технопарк',
            'appointment_en' => 'Technopark',
            'appointment_tm' => 'Tehnologiýa merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торгово-выставочный комплекс',
            'appointment_en' => 'Trade-exhibition complex',
            'appointment_tm' => 'Söwda sergi merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Торгово-офисный комплекс',
            'appointment_en' => 'Trade-office complex',
            'appointment_tm' => 'Söwda ofis merkezi'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Склад',
            'appointment_en' => 'Warehouse',
            'appointment_tm' => 'Ammar'
        ]);

        PossibleAppointment::create([
            'appointment_ru' => 'Складской комплекс',
            'appointment_en' => 'Warehouse complex',
            'appointment_tm' => 'Ammar toplumy'
        ]);
    }
}
