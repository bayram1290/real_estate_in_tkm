<?php

use Illuminate\Database\Seeder;
use App\Conditioning;

class ConditioningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conditioning::create([
           'conditioning_ru' => 'местное',
           'conditioning_en' => 'local',
           'conditioning_tm' => 'bina içinde'
        ]);

        Conditioning::create([
            'conditioning_ru' => 'центральное',
            'conditioning_en' => 'central',
            'conditioning_tm' => 'merkezi'
        ]);

        Conditioning::create([
            'conditioning_ru' => 'нет',
            'conditioning_en' => 'no',
            'conditioning_tm' => 'ýok'
        ]);
    }
}
