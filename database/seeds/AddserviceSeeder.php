<?php

use Illuminate\Database\Seeder;

class AddserviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\AddService::create([
            'service_ru' => 'Ответственное хранение',
            'service_en' => 'Secure storage',
            'service_tm' => 'Jogapkärlikli gorama'
        ]);

        \App\AddService::create([
            'service_ru' => 'Таможня',
            'service_en' => 'Customs office',
            'service_tm' => 'Gümrük'
        ]);

        \App\AddService::create([
            'service_ru' => 'Транспортные услуги',
            'service_en' => 'Transport services',
            'service_tm' => 'Transport hyzmatlary'
        ]);
    }
}
