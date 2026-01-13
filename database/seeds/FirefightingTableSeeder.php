<?php

use Illuminate\Database\Seeder;
use App\Firefighting;

class FirefightingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Firefighting::create([
           'firefighting_ru' => 'гидрантная',
           'firefighting_en' => 'hydrant',
           'firefighting_tm' => 'gidrant'
        ]);

        Firefighting::create([
            'firefighting_ru' => 'спринклерная',
            'firefighting_en' => 'sprinkler',
            'firefighting_tm' => 'sprinkler'
        ]);

        Firefighting::create([
            'firefighting_ru' => 'порошковая',
            'firefighting_en' => 'powdered',
            'firefighting_tm' => 'poroşokly'
        ]);

        Firefighting::create([
            'firefighting_ru' => 'газовая',
            'firefighting_en' => 'gas',
            'firefighting_tm' => 'gaz'
        ]);

        Firefighting::create([
            'firefighting_ru' => 'сигнализация',
            'firefighting_en' => 'alarm',
            'firefighting_tm' => 'duýduryş ulgamy'
        ]);

        Firefighting::create([
            'firefighting_ru' => 'нет',
            'firefighting_en' => 'no',
            'firefighting_tm' => 'ýok'
        ]);
    }
}
