<?php

use Illuminate\Database\Seeder;

class RentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\RentType::create([
           'type_ru' => 'Частная собственность',
           'type_en' => 'Private property',
           'type_tm' => 'Hususy emläk'
        ]);

        \App\RentType::create([
            'type_ru' => 'Субаренда',
            'type_en' => 'Subrent',
            'type_tm' => 'Garaşly kärende'
        ]);
    }
}
