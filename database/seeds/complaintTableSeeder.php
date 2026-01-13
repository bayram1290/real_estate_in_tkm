<?php

use Illuminate\Database\Seeder;
use App\Complaint;

class complaintTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        Complaint::create([
            'tm' => 'Suratlar we wideolar',
            'ru' => 'Фотографии и видеоролики',
            'en' => 'Photos and videos'
        ]);

        Complaint::create([
            'tm' => 'Baha ýada ylalaşyk şertleri',
            'ru' => 'Цена или условия сделки',
            'en' => 'Price or terms of the deal'
        ]);

        Complaint::create([
            'tm' => 'Binanyň, jaýyň parametrleri',
            'ru' => 'Параметры помещения, здания',
            'en' => 'Room, building parameters'
        ]);

        Complaint::create([
            'tm' => 'Salgy',
            'ru' => 'Адрес',
            'en' => 'Address'
        ]);

        Complaint::create([
            'tm' => 'Habarlaşyp bolmaýar',
            'ru' => 'Невозможно дозвониться',
            'en' => 'Unable to reach'
        ]);

        Complaint::create([
            'tm' => 'Bina tapylmady ýada bildiriş asylsyz',
            'ru' => 'Объект не существует или объявление неактуально',
            'en' => 'Property not exist or property not relevant'
        ]);

        Complaint::create([
            'tm' => 'Kanuny meseleler',
            'ru' => 'Правовые вопросы',
            'en' => 'Legal issues'
        ]);

        Complaint::create([
            'tm' => 'Nädogry beýannama',
            'ru' => 'Некорректное описание',
            'en' => 'Incorrect description'
        ]);

        Complaint::create([
            'tm' => 'Bildiriş gaýtalanýar',
            'ru' => 'Объявление дубль',
            'en' => 'Property is duplicated'
        ]);

        Complaint::create([
            'tm' => 'Başga',
            'ru' => 'Другие',
            'en' => 'Other'
        ]);
    }
}
